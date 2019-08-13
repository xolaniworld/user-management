<?php


namespace Application;


class Request
{
    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }
}