<?php

class FeedbackGateway extends \PHPUnit\Framework\TestCase
{
    private $gateway;
    private $pdo;
    private $id;

    public function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->gateway = new \Application\FeedbackGateway($this->pdo);

        $this->insertTestUser();
    }

    public function testInsertSenderReciverTitleFeedbackAttachment()
    {
        $this->gateway->insertSenderReciverTitleFeedbackAttachment('user', 'reciver', 'title', 'description', 'attachment');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select sender, reciver, title,feedbackdata,attachment from feedback where id='.$id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('user', $obj->sender);
        $this->assertEquals('reciver', $obj->reciver);
        $this->assertEquals('title', $obj->title);
        $this->assertEquals('description', $obj->feedbackdata);
        $this->assertEquals('attachment', $obj->attachment);

        $this->delete($id);
    }

    public function testCountByReciver()
    {
        $this->assertGreaterThan(0,      $this->gateway->countByReciver('reciver'));
    }

    public function testFindByReciver()
    {
        list($results, $count) = $this->gateway->findByReciver('reciver');
        $this->assertIsArray($results);
        $this->assertGreaterThan(0, $count);
    }

    public function insertByUserReciverDescription($sender, $reciver, $message)
    {
        $this->gateway->insertByUserReciverDescription('sender', 'reciver', 'message');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select sender, reciver, feedbackdata from feedback where id='.$id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('user', $obj->sender);
        $this->assertEquals('reciver', $obj->reciver);
        $this->assertEquals('message', $obj->feedbackdata);

        $this->delete($id);
    }

    public function tearDown(): void
    {
        $this->delete($this->id);
    }

    private function delete($id)
    {
        $this->pdo->exec("delete from feedback where id=" . $id);
    }

    private function insertTestUser()
    {
        $sql = "insert into feedback (sender, reciver, title,feedbackdata,attachment) values ('user','reciver','title','description','attachment')";
        $this->pdo->query($sql);
        $this->id = $this->pdo->lastInsertId();
    }
}