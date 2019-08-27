<?php declare(strict_types=1);

namespace Application\Admin;


use Application\Admin\AdminGateway;

class AdminTransaction
{

    private $adminGateway;
    private $error = '';
    private $msg = '';

    public function __construct(AdminGateway $adminGateway)
    {
        $this->adminGateway = $adminGateway;
    }

    public function submitLogin(string $username, string $password): bool
    {
        $password = md5($password);
        return $this->adminGateway->countByUsernameAndPassword($username, $password) > 0;
    }

    public function submitChangePassword(string $username, string $password, string $newpassword)
    {
        $password = md5($password);
        $newpassword = md5($newpassword);
        if ($this->adminGateway->countPasswordByPasswordAndUsername($username, $password) > 0) {
            $this->adminGateway->updatePasswordByUsername($username, $newpassword);
            return true;
        }
        return false;
    }
}