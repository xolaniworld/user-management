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

    public function test_can_login_if_at_least_one_user_is_found()
    {
        $this->gateway->countByUsernameAndPassword('username', md5('password'))->willReturn(1);

        $this->assertTrue(
            $this->transaction->submitLogin('username', 'password')
        );
    }

    public function test_Login_fails_when_zero_users_are_founds_when_submitting_username_and_password()
    {
        $this->gateway->countByUsernameAndPassword('username', md5('wrong-password'))->willReturn(0);

        $this->assertFalse(
            $this->transaction->submitLogin('username', 'wrong-password')
        );
    }

    public function test_submitChangePassword_returns_true_when_matching_username_password_is_found()
    {
        //user is found returns 1
        $this->gateway->countPasswordByPasswordAndUsername('username', md5('password'))->willReturn(1);

        $this->gateway->updatePasswordByUsername('username', md5('password2'))->willReturn('void');

        $this->assertTrue(
            $this->transaction->submitChangePassword('username', 'password', 'password2')
        );
    }

    public function test_submitChangePassword_returns_false_when_username_with_Matching_Password_Is_Not_Found()
    {
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