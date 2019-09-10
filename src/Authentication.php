<?php

namespace Application;


class Authentication
{
    public static function isNotLoggedIn()
    {
        $session =\Application\Session::getSession();

        if (! $session->has('alogin')) {
            return true;
        }

        return strlen($session->get('alogin')) === 0;
    }
}