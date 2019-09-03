<?php


namespace Application\Users;


use Application\Filesystem;
use Application\Request;
use Application\UsersGateway;

class UsersTransactions
{
    private $usersGateway;
    private $request;
    private $filesystem;

    public function __construct(UsersGateway $usersGateway, Request $request, Filesystem $filesystem)
    {
        $this->usersGateway = $usersGateway;
        $this->request = $request;
        $this->filesystem = $filesystem;
    }

    public function changePassword($username, $password, $newpassword)
    {
        $password = md5($password);
        $newpassword = md5($newpassword);
        if ($this->usersGateway->countByUsernameAndPassword($username, $password) > 0) {
            $this->usersGateway->updatePasswordByUsername($newpassword, $username);
            return true;
        }
        return false;
    }

    public function submitEdit()
    {
        $this->updateUser(true);
    }

    public function findByUserId($id)
    {
        return $this->usersGateway->findById($id);
    }

    public function submitEditFrontEnd()
    {
        $this->updateUser(false);
    }

    private function updateUser($adminUser = true)
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $gender = $this->request->getPost('gender');
        $mobileno = $this->request->getPost('mobileno');
        $designation = $this->request->getPost('designation');
        $idedit = $this->request->getPost('idedit');
        $imageFiles = $this->request->getFile('image');

        if ($adminUser) {
            $image = $this->filesystem->upload($imageFiles);
            return $this->usersGateway->updateByIdWithGender($name, $email, $gender, $mobileno, $designation, $image, $idedit);
        } else {
            $image = $this->filesystem->upload($imageFiles);
            return $this->usersGateway->updateById($name, $email, $mobileno, $designation, $image, $idedit);
        }

    }

    public function deleteUserById()
    {
        $id = $this->request->getQuery('del');
        return $this->usersGateway->deleteById($id);
    }

    public function updateStatusUnConfirmed()
    {
        $memstatus = 1;
        return $this->updateStatusById($memstatus);
    }

    public function updateStatusConfirmed()
    {
        $memstatus = 0;
        return $this->updateStatusById($memstatus);
    }

    private function updateStatusById($memstatus)
    {
        $aeid = intval($this->request->getQuery('unconfirm'));
        return $this->usersGateway->updateStatusById($memstatus, $aeid);
    }

    public function updateFeedback()
    {
        if ($this->request->queryIsset('del')) {
            $id = $this->request->getQuery('del');
            $this->usersGateway->deleteById($id);
            $msg = "Data Deleted successfully";
        }

        if ($this->request->requestIsset('unconfirm')) {
            $aeid = intval($this->request->getQuery('unconfirm'));
            $memstatus = 1;
            $this->usersGateway->updateStatusById($memstatus, $aeid);
            $msg = "Changes Sucessfully";
        }

        if ($this->request->requestIsset('unconfirm')) {
            $aeid = intval($this->request->getQuery('confirm'));
            $memstatus = 0;
            $this->usersGateway->updateStatusById($memstatus, $aeid);
            $msg = "Changes Sucessfully";
        }

        return $msg;
    }

}