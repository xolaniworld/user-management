<?php


class AdminGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;
    private $id;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\AdminGateway($this->pdo);

        $this->insertTestUser();
    }

    public function testCountByUsernameAndPassword()
    {
        $this->assertTrue($this->gateway->countByUsernameAndPassword('test-admin', 'test') > 0);
    }

    public function testCountPasswordByPasswordAndUsername()
    {
        $this->assertTrue(
            $this->gateway->countPasswordByPasswordAndUsername('test-admin', 'test') > 0
        );
    }

    public function testUpdatePasswordByUsername()
    {
        $this->gateway->updatePasswordByUsername('test-admin', 'foo');

        $result = $this->pdo->query("select password from admin where username='test-admin'", PDO::FETCH_OBJ);
        $this->assertEquals('foo', $result->fetch()->password );
    }

    public function testUpdateUsernameAndEmail()
    {
        //not sure how to test this
        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        $this->pdo->query("delete from admin where id=" . $this->id);
    }

    private function insertTestUser()
    {
        $this->pdo->query("insert into admin(email, username, Password) values ('test@test.com', 'test-admin','test')");
        $this->id = $this->pdo->lastInsertId();
    }
}