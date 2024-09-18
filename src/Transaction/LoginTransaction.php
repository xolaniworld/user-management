<?php


namespace App\Transaction;


use App\Gateway\UsersGateway;

class LoginTransaction
{
    private $usersGateway;

    /**
     * @param UsersGateway $usersGateway
     */
    public function __construct(UsersGateway $usersGateway)
    {
        $this->usersGateway = $usersGateway;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function authenticate($email, $password): bool
    {
        $passwordHash = $this->usersGateway->getPasswordHasByEmail($email);

        if ($passwordHash === null) {
            return false;
        }

        return password_verify($password, $passwordHash);
    }
}