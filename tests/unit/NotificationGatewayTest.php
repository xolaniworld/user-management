<?php

class NotificationGateway extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;
    private $id;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\Gateways\NotificationGateway($this->pdo);

        $this->insertTestUser();
    }

    public function testInsertUserreceiverType()
    {

        $this->gateway->insertUserreceiverType('foo-1', 'bar-1', 'baz-1');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select notiuser, notireceiver, notitype from notification where id=' . $id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('foo-1', $obj->notiuser);
        $this->assertEquals('bar-1', $obj->notireceiver);
        $this->assertEquals('baz-1', $obj->notitype);

        $this->pdo->exec('delete from notification where id='.$id);
    }

    public function testCountByreceiver()
    {
        $this->assertGreaterThan(0,$this->gateway->countByreceiver('foo'));
    }

    public function testFindByNotireceiver()
    {
        list($results, $count) = $this->gateway->findByNotireceiver('foo');
        $this->assertIsArray($results);
        $this->assertGreaterThan(0, $count);
    }

    public function tearDown(): void
    {
        $this->pdo->query("delete from notification where id=" . $this->id);
    }

    private function insertTestUser()
    {
        $this->pdo->query("insert into notification (notireceiver, notiuser, notitype) values ('foo', 'bar', 'baz')");
        $this->id = $this->pdo->lastInsertId();
    }
}