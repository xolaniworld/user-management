<?php

namespace App\Transactions;


use App\Gateways\UsersGateway;

class DownloadTransaction
{
    private $gateway;

    public function __construct(UsersGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function download()
    {
        $output = "#, Name, Email, Gender, Phone, Designation \n";
        $filename = "users-list";
        list($results, $count) = $this->gateway->findAllUsers();
        $cnt = 1;
        if ($count > 0) {
            foreach ($results as $result) {
                $output .= "$cnt, $result->name, $result->email, $result->gender, $result->mobile, $result->designation \n";
                $cnt++;
            }
        }
        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . $filename . "-report.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $output;
        exit;
    }
}