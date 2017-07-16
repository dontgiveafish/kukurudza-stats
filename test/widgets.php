<?php

// this is a file to test widgets
// @todo add composer autoload

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/dashboard/Widget.php';
require_once __DIR__ . '/../lib/dashboard/widget/Image.php';
require_once __DIR__ . '/../lib/dashboard/widget/Value.php';
require_once __DIR__ . '/../lib/dashboard/widget/Dataset.php';
require_once __DIR__ . '/../lib/dashboard/widget/Chart.php';

// draw an image

$widget = new Dashboard\Widget\Image([
    'image' => 'logo.jpeg',
    'title' => 'test'
]);

echo $widget;

// draw a number

$widget = new Dashboard\Widget\Value([
    'value' => 42,
    'diff' => 41,
    'title' => 'is an answer'
]);

echo $widget;

// create a dataset

$input = [
    '2017-07-01' => 1,
    '2017-07-02' => 4,
    '2017-07-03' => 9,
];

$dataset = \Dashboard\Widget\Dataset::createFromArray($input);

// draw a chart

$chart = new \Dashboard\Widget\Chart([
    'title' => 'new chart',
    'labels' => array_keys($input),
    'dataset' => $dataset,
]);

echo $chart;
