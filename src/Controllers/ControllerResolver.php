<?php


namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as SymfonyControllerResolver;

class ControllerResolver extends SymfonyControllerResolver
{
    /**
     * {@inheritdoc}
     */
    public function getController(Request $request): callable|false
    {
        return parent::getController($request);
    }
}