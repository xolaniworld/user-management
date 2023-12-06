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

    public function add($name, $email, $password, $gender, $mobileno, $designation, $image)
    {
        $sql ="INSERT INTO users(name,email, password, gender, mobile, designation, image) VALUES(:name, :email, :password, :gender, :mobileno, :designation, :image)";
        $query= $this->dbh -> prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
        $query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query-> bindParam(':designation', $designation, PDO::PARAM_STR);
        $query-> bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $this->dbh->lastInsertId();
        return $lastInsertId;
    }

}