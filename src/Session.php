<?php


namespace Application;


class Session
{
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

    public function destroy()
    {
        session_destroy(); // destroy session
    }
}