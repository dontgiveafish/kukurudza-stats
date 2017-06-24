<?php

class DateChart
{
    protected $format, $data = [];

    public function __construct($format = 'Y-m-d')
    {
        $this->format = $format;
    }

    public function setDot(DateTime $date, $key, $value = false)
    {
        $date = $date->format($this->format);
        $this->data[$date][$key] = $value;
    }

    public function getDots()
    {
        $dots = array_map('count', $this->data);
        return $dots;
    }

    public function getChart(DateTime $from, DateTime $to, $default_value = 0)
    {
        $chart = [];
        $today = clone $from;
        $dots = $this->getDots();

        while ($today <= $to) {
            $date = $today->format($this->format);
            $chart[$date] = $dots[$date] ?? $default_value;
            $today->modify('+1 day');
        }

        return $chart;
    }
}
