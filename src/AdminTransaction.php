<?php

namespace Application;


class AdminTransaction
{
    private $adminGateway;
    private $request;

    public function __construct(AdminGateway $adminGateway, Request $request)
    {
        $this->adminGateway = $adminGateway;
        $this->request = $request;
    }

    public function login($username, $password)
    {
        $password = md5($password);
        if ($this->adminGateway->countByUsernameAndPassword($username, $password) > 0) {
            $this->request->setSession('alogin', $username);
            $_SESSION['alogin'] = $username;
            return true;
        }

        return false;
    }
}