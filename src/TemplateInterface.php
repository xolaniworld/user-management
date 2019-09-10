<?php
namespace Application;


interface TemplateInterface
{
    public function render($template, array $data = []);
}