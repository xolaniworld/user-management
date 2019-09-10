<?php

namespace Application;


class Authentication
{
    public static function isNotLoggedIn()
    {
        $session = get_session();

        if (! $session->has('alogin')) {
            return true;
        }

        return strlen($session->get('alogin')) === 0;
    }
}