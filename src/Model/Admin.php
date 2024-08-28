<?php declare(strict_types=1);

namespace App\Model;

use App\Gateway\AdminGateway;

class Admin
{
    public function login(string $username, string $password) : bool
    {
        $adminGateway = new AdminGateway(get_database());
        $passwordHash = $adminGateway->getPasswordHashByUsername($username);
        if ($passwordHash === null) {
            return false;
        }

        return password_verify($password, $passwordHash);
    }
}