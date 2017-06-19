<?php

require_once 'vendor/autoload.php';
require_once 'lib/MixpanelAdapter.php';
require_once 'lib/DateChart.php';

$config = require __DIR__ . '/config.php';

// configure main dates

$today = new DateTime();
$week_ago = (clone $today)->modify('-1 week');
$day_ago = (clone $today)->modify('-1 day');

// get events mixpanel

$mixpanel = new MixpanelAdapter($config['mixpanel_secret'], $config['mixpanel_jpl_path']);

$events = $mixpanel->get('telegram_playbill_requests', [
    'from_date' => $week_ago->format('Y-m-d'),
    'to_date' => $today->format('Y-m-d'),
]);

// calculate main numbers

$found = array_column(array_column($events, 'properties'), 'found');

$total = count($events);
$avg_found = round(array_sum($found) / count($found));
$not_found = (count($found) - count(array_filter($found)));

// group events by days and users

$requests_per_day = new DateChart();
$users_per_day = new DateChart();

foreach ($events as $e => $event) {
    $date = (new DateTime())->setTimestamp($event['time'] / 1000);
    $chat_id = $event['properties']['chat_id'];

    $requests_per_day->setDot($date, $e);
    $users_per_day->setDot($date, $event['properties']['chat_id']);
}

// export data

$data = [
    'events' => [
        'total' => $total,
        'found_avg' => $avg_found,
        'not_found' => $not_found,
    ],
    'charts' => json_encode([
        'requests_per_day' => $requests_per_day->getChart($week_ago, $today),
        'users_per_day' => $users_per_day->getChart($week_ago, $today),
    ]),
];

// render and save template with mustache

Mustache_Autoloader::register();

$mustache = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/views', [
        'extension' => 'tpl'
    ]),
]);

$tpl = $mustache->loadTemplate('index');

$html = $tpl->render($data);
echo $html;

file_put_contents(__DIR__ . '/index.html', $html);
