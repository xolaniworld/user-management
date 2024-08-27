<?php


namespace App;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request
{
    public function getName()
    {
        return session_name();
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

    private function filter($string)
    {
        return strip_tags($string);
    }
}