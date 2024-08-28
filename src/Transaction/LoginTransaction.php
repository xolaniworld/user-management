<?php


namespace App\Transaction;


use App\Gateway\UsersGateway;

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
        $passwordHash = $this->usersGateway->getPasswordHasByEmail($email, $status);

        if ($passwordHash === null) {
            return false;
        }

        return password_verify($password, $passwordHash);
    }
}