<?php


namespace Application;


use PDO;

class AdminGateway extends AbstractGateway
{
    public function countByEmailAndPassword($email, $password)
    {
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        var_dump($results);
echo "------------------------$email---$password-------->". $query->rowCount();
        return $query->rowCount();
    }

    public function countPasswordByPasswordAndUsername($username, $password)
    {
        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        return $query->rowCount();
    }

    public function updatePasswordByUsername($username, $newpassword)
    {
        $con = "update admin set Password=:newpassword where UserName=:username";
        $chngpwd1 = $this->pdo->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
    }

    public function updateUsernameAndEmail($name, $email)
    {
        $sql="UPDATE admin SET username=(:name), email=(:email)";
        $query = $this->pdo->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
    }
}