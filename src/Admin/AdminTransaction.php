<?php declare(strict_types=1);

namespace Application\Admin;


use Application\AdminGateway;
use Application\Request;
use Application\Session;
use Application\Response;

class AdminTransaction
{

    private $adminGateway;
    private $request;
    private $error = '';
    private $msg = '';

    public function __construct(AdminGateway $adminGateway)
    {
        $this->adminGateway = $adminGateway;
    }

    public function submitlogin(string $username, string $password):bool
    {
        $password = md5($password);
        return $this->adminGateway->countByUsernameAndPassword($username, $password) > 0;
    }

    public function submitChangePassword(string $username, string $password, string $newpassword):void
    {
        $password = md5($password);
        $newpassword = md5($newpassword);
        if ($this->adminGateway->countPasswordByPasswordAndUsername($username, $password) > 0) {
            $this->adminGateway->updatePasswordByUsername($username, $newpassword);
            $this->msg = "Your Password succesfully changed";
            return;
        }

        $this->error = "Your current password is not valid.";
        return;
    }

    public function getError():string
    {
        return $this->error;
    }

    public function getMsg():string
    {
        return $this->msg;
    }
}