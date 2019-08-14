<?php


namespace Application;


class Filesystem
{
    public function moveUploadedFile($filename, $destination)
    {
        return move_uploaded_file ($filename, $destination);
    }
}