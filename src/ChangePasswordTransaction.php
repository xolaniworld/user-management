<?php


namespace Application;


class ChangePasswordTransaction
{
    private $adminGateway;
    private $request;

    public function __construct(AdminGateway $adminGateway, Request $request)
    {
        $this->adminGateway = $adminGateway;
        $this->request = $request;
    }

    public function changePassword($oldPassword, $newPassword)
    {
        $password = md5($oldPassword);
        $newpassword = md5($newPassword);
        $username = $this->request->getSession('alogin');
        if ($this->adminGateway->countPasswordByPasswordAndUsername($username, $password) > 0) {
            $this->adminGateway->updatePasswordByUsername($username, $newpassword);
            return true;
        }

        return false;
    }
}