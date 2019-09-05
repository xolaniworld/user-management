<?php


namespace Application;


class RegisterTransaction
{
    private $usersGateway;
    private $notificationGateway;
    private $filesystem;

    public function __construct(UsersGateway $usersGateway, NotificationGateway $notificationGateway, Filesystem $filesystem)
    {
        $this->usersGateway = $usersGateway;
        $this->notificationGateway = $notificationGateway;
        $this->filesystem = $filesystem;
    }

    public function submitRegister(Request $request)
    {
        $name = $request->getPost('name');
        $email = $request->getPost('email');
        $password = md5($request->getPost('password'));
        $gender = $request->getPost('gender');
        $mobileno = $request->getPost('mobileno');
        $designation = $request->getPost('designation');
        $image = $this->filesystem->upload($request->getFile('image'));

        $notitype = 'Create Account';
        $reciver = 'Admin';
        $sender = $email;
        $status = 1;

        $this->notificationGateway->insertUserReciverType($sender, $reciver, $notitype);
        return $this->usersGateway->insertUser($name, $email, $password, $gender, $mobileno, $designation, $image, $status);
    }
}