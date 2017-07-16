<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 15.07.17
 * Time: 21:51
 */

namespace Dashboard\Widget;

class Chart extends \Dashboard\Widget
{
    protected $labels, $dataset;

    public function run(): array
    {
        $values = [];
        $dataset = @$this->dataset->run()['dataset'];

        // fill empty keys with zero
        foreach ($this->labels as $label) {
            $value = @$dataset[$label];
            $values[] = $value ? @$value->run()['value'] : 0;
        }

        return [
            'labels' => $this->labels,
            'values' => $values,
        ];
    }
}
