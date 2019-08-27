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

    public function testSubmitChangePassword()
    {
        $this->gateway->countByUsernameAndPassword('admin', md5('password'))->willReturn(1);

        $this->assertTrue(
            $this->transaction->submitLogin('admin', 'password')
        );
    }

    public function testLoginFalse()
    {
        $this->gateway->countByUsernameAndPassword('admin', md5('wrong-password'))->willReturn(0);

        $this->assertFalse(
            $this->transaction->submitLogin('admin', 'wrong-password')
        );
    }

    public function testChangePassword()
    {
        $username = 'admin';
        $oldPassword = 'secret';
        $newPassword = 'secret2';

        $this->gateway->countPasswordByPasswordAndUsername($username, md5($oldPassword))->willReturn(1);
        $this->gateway->updatePasswordByUsername($username, md5($newPassword))->willReturn(0);

        $this->assertTrue(
            $this->transaction->submitChangePassword($username, $oldPassword, $newPassword)
        );
    }

    public function testChangePasswordFalse()
    {
        $username = 'admin';
        $oldPassword = 'secret';
        $newPassword = 'secret2';

        $this->gateway->countPasswordByPasswordAndUsername($username, md5($oldPassword))->willReturn(0);

        $this->assertFalse(
            $this->transaction->submitChangePassword($username, $oldPassword, $newPassword)
        );
    }

    protected function tearDown():void
    {
        $this->prophet->checkPredictions();
    }
}