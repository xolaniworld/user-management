<?php

class AdminTransactionTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $gateway;
    private $transaction;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $this->gateway = $this->prophet->prophesize('Application\Admin\AdminGateway');
        $request = $this->prophet->prophesize('Application\Request');

        $this->transaction = new Application\Admin\AdminTransaction($this->gateway->reveal(), $request->reveal());
    }

    public function test_submitLogin()
    {
        $this->gateway->countByUsernameAndPassword('username', md5('wrong-password'))->willReturn(0);

        $this->assertFalse(
            $this->transaction->submitLogin('username', 'wrong-password')
        );

        $this->gateway->countByUsernameAndPassword('username', md5('password'))->willReturn(1);

        $this->assertTrue(
            $this->transaction->submitLogin('username', 'password')
        );
    }

    /**
     *
     */
    public function test_submitChangePassword()
    {
        //user is found returns 1
        $this->gateway->countPasswordByPasswordAndUsername('username', md5('password'))->willReturn(1);

        $this->gateway->updatePasswordByUsername('username', md5('password2'))->willReturn('void');

        $this->assertTrue(
            $this->transaction->submitChangePassword('username', 'password', 'password2')
        );

        // user not found returns 0
        $this->gateway->countPasswordByPasswordAndUsername('username', md5('password'))->willReturn(0);

        $this->assertFalse(
            $this->transaction->submitChangePassword('username', 'password', 'password2')
        );
    }

    protected function tearDown():void
    {
        $this->prophet->checkPredictions();
    }
}