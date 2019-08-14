<?php


namespace Application\Admin;


use Application\AdminGateway;
use Application\Request;

class AdminTransactions
{
    private $adminGateway;
    private $request;
    private $error;
    private $msg;

    public function __construct(AdminGateway $adminGateway, Request $request)
    {
        $this->adminGateway = $adminGateway;
        $this->request = $request;
    }

    public function changePassword()
    {
        if ($this->request->postIsset('submit')) {
            $password = md5($this->request->getPost('password'));
            $newpassword = md5($this->request->getPost('newpassword'));
            $username = $this->request->getSession('alogin');
            if ($this->adminGateway->countPasswordByPasswordAndUsername($username, $password) > 0) {
                $this->adminGateway->updatePasswordByUsername($username, $newpassword);
                $this->msg = "Your Password succesfully changed";
            } else {
                $this->error = "Your current password is not valid.";
            }
        }
    }

    public function getError()
    {
        return $this->error;
    }

    public function getMsg()
    {
        return $this->msg;
    }
}