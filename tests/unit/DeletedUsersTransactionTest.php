<?php


use Application\DeletedUserGateway;

class DeletedUsersTransactionTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $transaction;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $g = $this->prophet->prophesize(DeletedUserGateway::class);
        $this->transaction = new \Application\DeletedUsersTransaction($g->reveal());
        $g->findAll()->willReturn(['record1', 'record2']);
    }

    public function test_findAllDeletedUsers()
    {
        $this->assertIsArray($this->transaction->findAllDeletedUsers());
    }

    public function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}