<?php

class UsersGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $email;
    private $status;

    public function setUp() : void
    {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\UsersGateway($pdo);

        $this->email = 'test@email.com';
        $this->password = md5(12345);
        $this->status = 1;
    }

    public function testFindByEmail()
    {
        $result = $this->gateway->findByEmail($this->email);

        $this->assertEquals(25, $result->id);
        $this->assertEquals('name', $result->name);
        $this->assertEquals($this->email, $result->email);
        $this->assertEquals($this->password, $result->password);
        $this->assertEquals('Male', $result->gender);
        $this->assertEquals('1234567890', $result->mobile);
        $this->assertEquals('designation', $result->designation);
        $this->assertEquals('test.jpg', $result->image);
        $this->assertEquals($this->status, $result->status);
    }

    public function testCountByEmailPasswordAndStatus()
    {
        $result = $this->gateway->countByEmailPasswordAndStatus($this->email, $this->password, $this->status);
        $this->assertTrue($result > 0);
    }
}