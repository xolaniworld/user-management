<?php

namespace Tests\Unit;
class LoginTransactionTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $transaction;
    private $gateway;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $this->gateway = $this->prophet->prophesize(\Application\Gateways\UsersGateway::class);
        $this->transaction = new \Application\Transactions\LoginTransaction($this->gateway->reveal());
    }

    public function test_submitLogin()
    {
        $this->gateway->countByEmailPasswordAndStatus('email@email.com', md5('password'), '1')->willReturn(1);
        $this->assertTrue(
            $this->transaction->submitLogin('email@email.com', 'password'),
            'Login passed'
        );

        $this->gateway->countByEmailPasswordAndStatus('email@email.com', md5('password'), '1')->willReturn(0);
        $this->assertFalse(
            $this->transaction->submitLogin('email@email.com', 'password'),
            'Login failed'
        );
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}