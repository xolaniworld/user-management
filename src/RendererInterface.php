<?php
namespace Application;


interface RendererInterface
{
    public function render($template, array $data = []);
}