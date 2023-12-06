<?php

namespace UserManagement\Admin;

use PDO;

class AdminRepository
{
    private $dbh;
    private $results;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function userLogin($email, $password)
    {
        $email=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
        $query= $this->dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $this->results = $query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount() > 0;
    }

    public function getResults()
    {
        return $this->results;
    }
}