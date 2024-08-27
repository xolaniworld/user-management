<?php


namespace App;


class Response
{
    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit;
    }
}