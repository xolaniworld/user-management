<?php

class UsersGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $pdo;
    private $result;
    private $gateway;
    private $name;
    private $email;
    private $status;
    private $password;
    private $md5Password;
    private $gender;
    private $mobileno;
    private $designation;
    private $image;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\Gateways\UsersGateway($this->pdo);

        $this->defaultDetails();
    }

    public function testFindByEmail()
    {
        $this->detailsTest();
        $this->assertEquals(25, $this->result->id);
        $this->assertEquals($this->md5Password, $this->result->password);
    }

    public function testCountByEmailPasswordAndStatus()
    {
        $result = $this->gateway->countByEmailPasswordAndStatus($this->email, $this->md5Password, $this->status);
        $this->assertGreaterThan(0,$result);
    }

    public function testCountByUsernameAndPassword()
    {
        $this->assertGreaterThan(0, $this->gateway->countByUsernameAndPassword($this->email, $this->md5Password));
    }

    public function testInsertUpdateAndDelete()
    {
        $this->insertUser();

        $this->detailsTest();

        $name = 'testtest';
        $email = 'emailemail@email.com';
        $mobileno = '0987654321';
        $designation = 'test-designation-test';
        $image = 'tester.jpg';
        $id = $this->pdo->lastInsertId();
        $this->gateway->updateById($name, $email, $mobileno, $designation, $image, $id);
        $result = $this->gateway->findByEmail($email);
        $this->assertEquals($name, $result->name);
        $this->assertEquals($email, $result->email);
        $this->assertEquals($designation, $result->designation);
        $this->assertEquals($image, $result->image);

        $this->assertGreaterThan(0, $this->gateway->findAllUsers());

        $this->assertGreaterThan(0, $this->gateway->countIds());

        $this->assertTrue($this->gateway->deleteByEmail($this->email));
    }

    public function testDeleteById()
    {
        $this->insertUser();
        $id = $this->pdo->lastInsertId();

        $newpassword = md5('newpassword');
        $this->gateway->updatePasswordByUsername($newpassword,  $this->email);
        $result = $this->gateway->findByEmail($this->email);
        $this->assertEquals($newpassword, $result->password);

        $this->gateway->deleteById($id);
        $this->assertTrue($this->gateway->countByUsernameAndPassword($this->email, $this->md5Password) === 0);
    }

    public function testFindAll()
    {
        $all = $this->gateway->findAll();
        $this->assertInstanceOf('stdClass', $all);
    }

    private function defaultDetails()
    {
        $this->name = 'name';
        $this->email = 'test@email.com';
        $this->password = 12345;
        $this->md5Password = md5($this->password);
        $this->gender = 'Male';
        $this->mobileno = 1234567890;
        $this->designation = 'designation';
        $this->image = 'test.jpg';
        $this->status = 1;
    }

    private function detailsTest()
    {
        $this->result = $this->gateway->findByEmail($this->email);

        $this->assertEquals($this->name, $this->result->name);
        $this->assertEquals($this->email, $this->result->email);
        $this->assertEquals($this->gender, $this->result->gender);
        $this->assertEquals($this->mobileno, $this->result->mobile);
        $this->assertEquals($this->designation, $this->result->designation);
        $this->assertEquals($this->image, $this->result->image);
        $this->assertEquals($this->status, $this->result->status);
    }

    private function insertUser()
    {
        $this->name = "test-{$this->name}";
        $this->email = "test-{$this->email}";
        $this->password = "test-{$this->password}";
        $this->gender = "test-{$this->gender}";
        $this->mobileno = "test-{$this->mobileno}";
        $this->designation = "test-{$this->designation}";
        $this->image = "test-{$this->image}";
        $this->gateway->insertUser($this->name, $this->email, $this->md5Password, $this->gender, $this->mobileno, $this->designation, $this->image, $this->status);
    }
}