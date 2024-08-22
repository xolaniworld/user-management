<?php

namespace Application\Models;

use Application\Gateways\AdminGateway;

class Admin
{
    public function login(string $username, string $password)
    {
        $adminGateway = new AdminGateway(get_database());

        $passwordHash = $adminGateway->getPasswordHashByUsername($username);

        if (password_verify($password, $passwordHash)) {
            return true;
        }

        return false;
    }
}