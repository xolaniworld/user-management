<?php


class AdminGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;
    private $id;

    private $username;
    private $email;
    private $username;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\AdminGateway($this->pdo);

        $this->pdo->query("insert into admin(email, username, Password) values ('test@test.com', 'test-admin','test')");
        $this->id = $this->pdo->lastInsertId();
    }

    public function testCountByEmailAndPassword()
    {
        $this->assertTrue($this->gateway->countByEmailAndPassword('test@test.com', 'test') > 0);
//        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
//        $query = $this->pdo->prepare($sql);
//        $query->bindParam(':email', $email, PDO::PARAM_STR);
//        $query->bindParam(':password', $password, PDO::PARAM_STR);
//        $query->execute();
//        $results = $query->fetchAll(PDO::FETCH_OBJ);
//
//        return $query->rowCount();
    }

//    public function countPasswordByPasswordAndUsername($username, $password)
//    {
//        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
//        $query = $this->pdo->prepare($sql);
//        $query->bindParam(':username', $username, PDO::PARAM_STR);
//        $query->bindParam(':password', $password, PDO::PARAM_STR);
//        $query->execute();
//        $results = $query->fetchAll(PDO::FETCH_OBJ);
//
//        return $query->rowCount();
//    }
//
//    public function updatePasswordByUsername($username, $newpassword)
//    {
//        $con = "update admin set Password=:newpassword where UserName=:username";
//        $chngpwd1 = $this->pdo->prepare($con);
//        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
//        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
//        $chngpwd1->execute();
//    }
//
//    public function updateUsernameAndEmail($name, $email)
//    {
//        $sql="UPDATE admin SET username=(:name), email=(:email)";
//        $query = $this->pdo->prepare($sql);
//        $query-> bindParam(':name', $name, PDO::PARAM_STR);
//        $query-> bindParam(':email', $email, PDO::PARAM_STR);
//        $query->execute();
//    }

    public function tearDown(): void
    {
        $this->pdo->query("delete from admin where id=" . $this->id);
    }
}