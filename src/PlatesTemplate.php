<?php


namespace Application;


use League\Plates\Engine;

class PlatesTemplate implements TemplateInterface
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