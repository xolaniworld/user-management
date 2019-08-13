<?php



class AdminTransactionTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $gateway;
    private $transaction;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $this->gateway = $this->prophet->prophesize('Application\AdminGateway');
        $reqiest = $this->prophet->prophesize('Application\Request');

        $this->transaction = new Application\AdminTransaction($this->gateway->reveal(), $reqiest->reveal());

    }

    public function testLogin()
    {
        $this->gateway->countByUsernameAndPassword('admin', md5('password'))->willReturn(1);

        $this->assertTrue(
            $this->transaction->login('admin', 'password')
        );
    }

    public function testLoginFalse()
    {
        $this->gateway->countByUsernameAndPassword('admin', md5('wrong-password'))->willReturn(0);

        $this->assertFalse(
            $this->transaction->login('admin', 'wrong-password')
        );
    }

    protected function tearDown():void
    {
        $this->prophet->checkPredictions();
    }
}