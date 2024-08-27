<?php


namespace App\Controllers;


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