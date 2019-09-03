<?php declare(strict_types=1);

namespace Application\Admin;


use PDO;
use Application\AbstractGateway;

class AdminGateway extends AbstractGateway
{
    protected $table = 'admin';

    public function countByUsernameAndPassword(string $username, string $password):int
    {
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function countPasswordByPasswordAndUsername(string $username, string $password):int
    {
        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function updatePasswordByUsername($username, $newpassword)
    {
        $con = "update admin set Password=:newpassword where UserName=:username";
        $chngpwd1 = $this->pdo->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        return $chngpwd1->execute();
    }

    public function updateAdminUsernameAndEmail($name, $email)
    {
        $sql="UPDATE admin SET username=(:name), email=(:email)";
        $query = $this->pdo->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
    }
}