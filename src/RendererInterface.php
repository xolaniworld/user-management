<?php
namespace App;


interface RendererInterface
{
    public function render($template, array $data = []);
}