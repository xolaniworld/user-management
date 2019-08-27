<?php
use Prophecy\Argument;

class AdminGatewayTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;
    private $gateway;
    private $pdo;

    public function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
        $this->pdo = $this->prophet->prophesize('PDO');

        $this->gateway = new \Application\Admin\AdminGateway($this->pdo->reveal());

        $query = $this->prophet->prophesize('PDOStatement');
        $this->pdo->prepare(Argument::type('string'))->willReturn($query->reveal());
        $query->bindParam(Argument::type('string'), Argument::type('string'), Argument::type('int'))->willReturn('void');
        $query->execute()->willReturn(true);
        $query->rowCount()->willReturn(1);
    }

    public function testCountByUsernameAndPassword()
    {
        $this->assertGreaterThan(0, $this->gateway->countByUsernameAndPassword('test-admin', 'test'));
    }

    public function testCountPasswordByPasswordAndUsername()
    {
        $this->assertGreaterThan(0, $this->gateway->countPasswordByPasswordAndUsername('test-admin', 'test'));
    }

    public function test_updatePasswordByUsername()
    {
        $pdo = $this->prophet->prophesize('PDO');

        $gateway = new \Application\Admin\AdminGateway($pdo->reveal());

        $query = $this->prophet->prophesize('PDOStatement');
        $this->pdo->prepare(Argument::type('string'))->willReturn($query->reveal());
        $query->bindParam(':username', 'iamuser', Argument::type('int'))->willReturn('void');
        $query->bindParam(':newpassword', 'secret', Argument::type('int'))->willReturn('void');

        $gateway->updatePasswordByUsername('iamuser', 'secret');
    }

    public function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}