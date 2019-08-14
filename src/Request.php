<?php


namespace Application;


class Request
{
    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function requestIsset($name)
    {
        return $_REQUEST[$name];
    }

    public function queryIsset($name)
    {
        return isset($_GET[$name]);
    }

    public function getQuery($name)
    {
        return $_GET[$name];
    }

    public function getFile($name)
    {
        return $_FILES[$name];
    }

    public function getPost($name)
    {
        return $_POST[$name];
    }

    public function postIsset($name)
    {
        return isset($_POST[$name]);
    }

    public function getSession($name)
    {
        return $_SESSION[$name];
    }
}