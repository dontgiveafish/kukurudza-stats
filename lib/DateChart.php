<?php

class DateChart
{
    protected $data = [];

    public function setDot(DateTime $date, $key, $value = false)
    {
        $date = $date->format('Y-m-d');
        $this->data[$date][$key] = $value;
    }

    public function getChart(DateTime $from, DateTime $to, $default_value = 0)
    {
        $chart = [];
        $today = clone $from;
        $dots = array_map('count', $this->data);

        while ($today <= $to) {
            $date = $today->format('Y-m-d');
            $chart[$date] = $dots[$date] ?? $default_value;
            $today->modify('+1 day');
        }

        return $chart;
    }
}
