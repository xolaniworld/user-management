<?php

namespace Application;


class Authentication
{
    public static function isNotLoggedIn()
    {
        if (! array_key_exists('alogin', $_SESSION)) {
            return true;
        }

        return strlen($_SESSION['alogin']) === 0;
    }
}