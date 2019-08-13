<?php


namespace Application;


class ChangePasswordTransactionTest
{
    private $prophet;
    private $gateway;
    private $transaction;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $this->gateway = $this->prophet->prophesize('Application\AdminGateway');
        $request = $this->prophet->prophesize('Application\Request');

        $this->transaction = new \Application\ChangePasswordTransaction($this->gateway->reveal(), $request->reveal());

    }

    public function testChangePassword()
    {
        $username = 'admin';
        $oldPassword = 'secret';
        $newPassword = 'secret2';

        $this->adminGateway->countPasswordByPasswordAndUsername($username, md5($oldPassword))->willReturn(1);

       $this->assertTrue(
           $this->transaction->changePassword($oldPassword, $newPassword)
       );
    }

    public function testChangePasswordFalse()
    {
        $username = 'admin';
        $oldPassword = 'secret';
        $newPassword = 'secret2';

        $this->adminGateway->countPasswordByPasswordAndUsername($username, md5($oldPassword))->willReturn(0);

        $this->assertFalse(
            $this->transaction->changePassword($oldPassword, $newPassword)
        );
    }
}