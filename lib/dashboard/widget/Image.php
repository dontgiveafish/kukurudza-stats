<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 15.07.17
 * Time: 21:51
 */

namespace Dashboard\Widget;

class Image extends \Dashboard\Widget
{
    protected $image;

    public function run(): array
    {
        return [
            'image' => $this->image
        ];
    }
}
