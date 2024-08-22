<?php

namespace Application\Transactions;

class Filesystem
{
    private $uploadPath;

    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    public function moveUploadedFile($filename, $destination)
    {
        return move_uploaded_file($filename, $destination);
    }

    public function upload($imageFiles)
    {
        $file = $imageFiles['name'];
        $file_loc = $imageFiles['tmp_name'];
        $new_file_name = strtolower($file);
        $final_file = str_replace(' ', '-', $new_file_name);

        if($this->moveUploadedFile($file_loc, $this->uploadPath . '/' . $final_file)) {
           return $final_file;
        }

        throw new \Exception("unable to move file to {$this->uploadPath}");
    }

    private function getUploadPath()
    {
        return rtrim(strtolower($this->uploadPath), '/') . '/';
    }
}