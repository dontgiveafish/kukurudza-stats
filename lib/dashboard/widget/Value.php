<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 15.07.17
 * Time: 21:51
 */

namespace Dashboard\Widget;

class Value extends \Dashboard\Widget
{
    protected $value, $diff;

    protected function trend($current, $previous = null)
    {
        if (empty($previous)) {
            return 0;
        }

        // @todo add trend strategies (ex +10%, 2x)
        // @todo add trend mood (going up is good or bad?)

        // calculate trend
        $trend = ($current - $previous) / $previous;

        $precision = abs($trend) < 1 ? 2 : 0;
        $trend = round($trend * 100,  $precision);

        // add symbols if needed
        if ($trend > 0) {
            $trend = '+' . $trend;
        }
        $trend .= '%';

        return $trend;
    }

    public function run(): array
    {
        $trend = $this->trend($this->value, $this->diff);

        return [
            'value' => $this->value,
            'trend' => $trend,
        ];
    }
}
