<?php


namespace Application\Transactions;


use Application\Gateways\UsersGateway;

class LoginTransaction
{
    private $usersGateway;

    public function __construct(UsersGateway $usersGateway)
    {
        $this->usersGateway = $usersGateway;
    }

    public function submitLogin($email, $password)
    {
        $status = '1';
        $password = md5($password);
        return $this->usersGateway->countByEmailPasswordAndStatus($email, $password, $status) > 0;
    }
}