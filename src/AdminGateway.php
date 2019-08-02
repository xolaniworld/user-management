<?php


namespace Application;


use PDO;

class AdminGateway extends AbstractGateway
{
    public function countByEmailAndPassword($email, $password)
    {
        $sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
        $query= $this->pdo -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        return $query->rowCount();
    }
}