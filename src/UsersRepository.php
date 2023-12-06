<?php

namespace UserManagement;

class UsersRepository extends AbstractRepository
{
    public function login($email, $password)
    {
        $status='1';
        $sql ="SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
        $query= $this->dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> bindParam(':status', $status, PDO::PARAM_STR);
        $query-> execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount() > 0;
    }
}