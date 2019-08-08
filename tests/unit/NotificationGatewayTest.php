<?php

class NotificationGateway extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;
    private $id;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\NotificationGateway($this->pdo);

        $this->insertTestUser();
    }

    public function testInsertUserReciverType()
    {

        $this->gateway->insertUserReciverType('foo', 'bar', 'baz');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select notiuser, notireciver, notitype from notification where id=' . $id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('foo', $obj->notiuser);
        $this->assertEquals('bar', $obj->notireciver);
        $this->assertEquals('baz', $obj->notitype);

        $this->pdo->exec('delete from notification where id='.$id);
    }

    public function testCountByReciver()
    {
        $this->assertTrue(
            $this->gateway->countByReciver('foo') > 0
        );
    }

    public function testFindByNotiReciver()
    {
        list($results, $count) = $this->gateway->findByNotiReciver('foo');
        $this->assertTrue(is_array($results));
        $this->assertTrue($count > 0);
    }

    public function tearDown(): void
    {
        $this->pdo->query("delete from notification where id=" . $this->id);
    }

    private function insertTestUser()
    {
        $this->pdo->query("insert into notification (notireciver, notiuser, notitype) values ('foo', 'bar', 'baz')");
        $this->id = $this->pdo->lastInsertId();
    }
}