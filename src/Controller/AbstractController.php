<?php


namespace App\Controller;


class AbstractController
{
    public function authenticated()
    {
        if (\App\Authentication::isNotLoggedIn()) {
            header('location: /');
            exit;
        }
    }
}