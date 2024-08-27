<?php

namespace App;


class Authentication
{
    public static function isNotLoggedIn()
    {
        $session = Session::getSession();

        if (! $session->has('alogin')) {
            return true;
        }

        return strlen($session->get('alogin')) === 0;
    }
}