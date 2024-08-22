<?php

class AbstractGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new class($this->pdo) extends  \Application\Gateways\AbstractGateway {};
    }

    public function test_selectAll()
    {
        $this->expectException(\Exception::class);
        $this->gateway->selectAll();

        $this->gateway = new class($this->pdo) extends  \Application\Gateways\AbstractGateway {
            protected $table = 'admin';
        };

        $this->assertIsArray($this->gateway->selectAll());
    }


    public function tearDown(): void
    {
        $this->pdo = null;
    }
}