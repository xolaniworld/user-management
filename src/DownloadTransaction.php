<?php

namespace Application;


class DownloadTransaction
{
    private $gateway;

    public function __construct(UsersGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function download()
    {
        $filename = "users-list";
        echo "#, Name, Email, Gender, Phone, Designation \n";
        list($results, $count) = $this->gateway->findAllUsers();
        $cnt = 1;
        if ($count > 0) {
            foreach ($results as $result) {
                echo "$cnt, $result->name, $result->email, $result->gender, $result->mobile, $result->designation \n";

                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=" . $filename . "-report.csv");
                header("Pragma: no-cache");
                header("Expires: 0");
                $cnt++;
            }
        }
    }
}