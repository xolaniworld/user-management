<?php


namespace Application\Controllers;

use Application\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Application\PlatesTemplate;
use Application\Users\UsersTransactions;
use Psr\Http\Message\ServerRequestInterface;

class UsersController
{
    private $request;
    private $transaction;
    private $session;
    private $template;

    public function __construct(ServerRequestInterface $request, UsersTransactions $transaction, PlatesTemplate $template, Session $session)
    {
        $this->request = $request;
        $this->transaction = $transaction;
        $this->template = $template;
        $this->session = $session;
    }

    public function profile()
    {
        $msg = null;
        if ($this->request->getMethod() === 'POST') {
            $this->transaction->submitEditFrontEnd();
            $msg = "Information Updated Successfully";
        }

        $alogin = $this->session->get('alogin');
        $result = $this->transaction->findByEmail($alogin);
        $cnt = 1;

        echo $this->template->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
    }

    public function changePassword()
    {
        $msg = null;
        $error = null;
        $alogin = $this->session->get('alogin');
        $input = $this->request->getParsedBody();

        // Code for change password
        if ($this->request->getMethod() === 'POST') {
            if ($this->transaction->changePassword($alogin, $input['password'], $input['newpassword'])) {
                $msg = "Your Password succesfully changed";
            } else {
                $error = "Your current password is not valid.";
            }
        }

        echo $this->template->render('change_password', compact('alogin','msg', 'error'));
    }

}