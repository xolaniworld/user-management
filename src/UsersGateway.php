<?php

namespace Application;
use PDO;

class UsersGateway extends AbstractGateway
{
    public function countByEmailPasswordAndStatus($email, $password, $status)
    {
        $sql = "SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        return $query->rowCount();
    }

    public function countByUsernameAndPassword($username, $password)
    {
        $sql ="SELECT Password FROM users WHERE email=:username and password=:password";
        $query= $this->pdo -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $query -> rowCount();
    }

    public function update($name, $email, $mobileno, $designation, $image, $idedit)
    {
        $sql="UPDATE users SET name=(:name), email=(:email), mobile=(:mobileno), designation=(:designation), Image=(:image) WHERE id=(:idedit)";
        $query = $this->pdo->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query-> bindParam(':designation', $designation, PDO::PARAM_STR);
        $query-> bindParam(':image', $image, PDO::PARAM_STR);
        $query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
    }

    public function updatePasswordByUsername($username, $newpassword)
    {
        $con="update users set password=:newpassword where email=:username";
        $chngpwd1 = $this->pdo->prepare($con);
        $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
    }
}