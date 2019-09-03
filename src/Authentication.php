<?php

namespace Application;


class Authentication
{
    public static function adminIsLogin()
    {
        if (! isset($_SESSION['alogin'])) {
            return false;
        }

        return strlen($_SESSION['alogin']) === 0;
    }
}