<?php


namespace Application;


class Response
{
    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit;
    }
}