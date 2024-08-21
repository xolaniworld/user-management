<?php


namespace Application\Controllers;


class AbstractController
{
    public function authenticated()
    {
        if (\Application\Authentication::isNotLoggedIn()) {
            header('location: /');
            exit;
        }
    }
}