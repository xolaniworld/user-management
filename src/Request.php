<?php


namespace Application;


class Request
{
    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function setSessionToEmptyArray()
    {
        $_SESSION = [];
    }

    public function getName()
    {
        return session_name();
    }

    public function unLoginSetSession()
    {
        unset($_SESSION['login']);
    }

    public function destroySession()
    {
        session_destroy(); // destroy session
    }

    public function requestIsset($name)
    {
        return isset($_REQUEST[$name]);
    }

    public function queryIsset($name)
    {
        return isset($_GET[$name]);
    }

    public function getQuery($name)
    {
        return $this->filter($_GET[$name]);
    }

    public function getFile($name)
    {
        return $_FILES[$name];
    }

    public function getPost($name)
    {
        return $this->filter($_POST[$name]);
    }

    public function postIsset($name)
    {
        return isset($_POST[$name]);
    }

    public function getSession($name)
    {
        return $_SESSION[$name];
    }

    public function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function filter($string)
    {
        return strip_tags($string);
    }
}