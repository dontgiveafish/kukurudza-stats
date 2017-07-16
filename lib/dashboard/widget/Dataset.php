<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 15.07.17
 * Time: 21:51
 */

namespace Dashboard\Widget;

class Dataset extends \Dashboard\Widget
{
    protected $dataset;

    /**
     * @param $input
     * @param string $title
     * @return Dataset
     */
    public static function createFromArray($input, $title = ''): Dataset
    {
        $dataset = new self([
            'title' => $title,
        ]);

        foreach ($input as $title => $value) {
            $dataset->setValue(new Value([
                'title' => $title,
                'value' => $value,
            ]));
        }

        return $dataset;
    }

    public function setValue(Value $value)
    {
        $key = $value->getTitle();
        $this->dataset[$key] = $value;
    }

    protected function draw(array $data = []): string
    {
        // @todo
        return '';
    }

    public function run(): array
    {
        return [
            'dataset' => $this->dataset,
        ];
    }
}
