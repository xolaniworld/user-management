<?php


namespace Application;


class Cookie
{
    public function set($name, $value = "", $expires = 0, $path = "", $domain = "", $secure = false , $httponly = false)
    {
        return setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
    }
}