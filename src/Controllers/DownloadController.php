<?php


namespace Application\Controllers;


use Application\Transactions\DownloadTransaction;

class DownloadController
{
    private $transaction;

    public function __construct(DownloadTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function download()
    {
        $this->transaction->download();
    }
}