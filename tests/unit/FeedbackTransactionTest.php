<?php

class FeedbackTransactionTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $transaction;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $g = $this->prophet->prophesize(\Application\Gateways\FeedbackGateway::class);
        $this->transaction = new \Application\Transactions\FeedbackTransaction($g->reveal());
        $g->findByreceiver('Admin')->willReturn(['feedback', 'total']);
    }

    public function test_findAdmin()
    {
        $this->transaction->findAdmin();
        $this->assertEquals('feedback', $this->transaction->getFeedback());
        $this->assertEquals('total', $this->transaction->getTotal());
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}