<?php


namespace Application;


class RegisterTransaction
{
    private $usersGateway;
    private $notificationGateway;
    private $filesystem;
    private $request;

    public function __construct(UsersGateway $usersGateway, NotificationGateway $notificationGateway, Filesystem $filesystem, Request $request)
    {
        $this->usersGateway = $usersGateway;
        $this->notificationGateway = $notificationGateway;
        $this->filesystem = $filesystem;
        $this->request = $request;
    }

    public function submitRegister()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        $gender = $this->request->getPost('gender');
        $mobileno = $this->request->getPost('mobileno');
        $designation = $this->request->getPost('designation');
        $image = $this->filesystem->upload($this->request->getFile('image'));

        $notitype = 'Create Account';
        $reciver = 'Admin';
        $sender = $email;
        $status = 1;

        $this->notificationGateway->insertUserReciverType($sender, $reciver, $notitype);
        return $this->usersGateway->insertUser($name, $email, $password, $gender, $mobileno, $designation, $image, $status);
    }
}