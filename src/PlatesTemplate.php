<?php


namespace App;


use League\Plates\Engine;

class PlatesTemplate implements RendererInterface
{
    private $renderer;

    public function __construct($templateDir)
    {
        $this->renderer = new Engine($templateDir);
    }

    public function render($template, array $data = [])
    {
        return $this->renderer->render($template, $data);
    }
}