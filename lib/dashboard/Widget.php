<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 15.07.17
 * Time: 21:44
 */

namespace Dashboard;

abstract class Widget
{
    protected $title;

    /**
     * @todo move it to run()
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Get data to draw
     * @return array
     */
    abstract public function run(): array;

    protected function getPath(): string
    {
        // get name of called class without parent namespace
        $child_class = get_called_class();
        $name = str_replace(__CLASS__, '', $child_class);

        // get path to template
        $parts = array_filter(explode('\\', $name));
        $path = implode(DIRECTORY_SEPARATOR, $parts);

        return $path;
    }

    protected function draw(array $data = []): string
    {
        $mustache = new \Mustache_Engine([
            'loader' => new \Mustache_Loader_FilesystemLoader(__DIR__ . '/widget/views'),
        ]);

        // render

        $path = $this->getPath();
        $template = $mustache->loadTemplate($path);
        $html = $template->render($data);

        return $html;
    }

    public function __toString()
    {
        // get data

        $defaults = [
            'title' => $this->title,
        ];

        $data = array_merge($defaults, $this->run());

        // draw widget
        $html = $this->draw($data);

        // return html
        return $html;
    }
}
