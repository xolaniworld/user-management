<?php


namespace App;

use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session
{
    private static $session;

    public static function start()
    {
        session_start();
    }

    public function get($name)
    {
        return $_SESSION[$name];
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function reset()
    {
        $_SESSION = [];
    }

    public function getName()
    {
        return session_name();
    }

    public function getCookieParams()
    {
        return session_get_cookie_params();
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public static function destroy()
    {
        static::getSession()->invalidate();
    }

    public static function getSession()
    {
        if (static::$session === null) {
            static::$session = new SymfonySession();
        }

        if (! static::$session->isStarted()) {
            static::$session->start();
        }

        return static::$session;
    }
}