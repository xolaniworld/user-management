<?php

namespace Application;


class Authentication
{
    public static function isLoggedIn()
    {
        if (! isset($_SESSION['alogin'])) {
            return false;
        }

        return strlen($_SESSION['alogin']) === 0;
    }
}