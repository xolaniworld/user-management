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

    public function test_insertSenderReciverTitleFeedbackAttachment()
    {
        $this->gateway->insertSenderReciverTitleFeedbackAttachment('user-1', 'reciver-1', 'title-1', 'description-1', 'attachment-1');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select sender, reciver, title,feedbackdata,attachment from feedback where id='.$id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('user-1', $obj->sender);
        $this->assertEquals('reciver-1', $obj->reciver);
        $this->assertEquals('title-1', $obj->title);
        $this->assertEquals('description-1', $obj->feedbackdata);
        $this->assertEquals('attachment-1', $obj->attachment);

        $this->delete($id);
    }

    public function test_countByReciver()
    {
        $this->assertGreaterThan(0,      $this->gateway->countByReciver('reciver'));
    }

    public function test_findByReciver()
    {
        list($results, $count) = $this->gateway->findByReciver('reciver');
        $this->assertIsArray($results);
        $this->assertGreaterThan(0, $count);
    }

    public function testInsertByUserReciverDescription()
    {
        $this->gateway->insertByUserReciverDescription('sender-2', 'reciver-2', 'message-2');
        $id = $this->pdo->lastInsertId();
        $sth = $this->pdo->query('select sender, reciver, feedbackdata from feedback where id='.$id, PDO::FETCH_OBJ);
        $obj = $sth->fetch();

        $this->assertEquals('sender-2', $obj->sender);
        $this->assertEquals('reciver-2', $obj->reciver);
        $this->assertEquals('message-2', $obj->feedbackdata);

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