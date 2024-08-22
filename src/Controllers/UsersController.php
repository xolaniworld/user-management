<?php


namespace Application\Controllers;

use Application\Auth;
use Application\PlatesTemplate;
use Application\Transactions\UsersTransactions;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UsersController extends AbstractController
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
        $this->authenticated();

        $msg = null;
        if ($this->request->getMethod() === 'POST') {
            $this->transaction->submitEditFrontEnd();
            $msg = "Information Updated Successfully";
        }

        $alogin = $this->session->get('alogin');
        $result = $this->transaction->findByEmail($alogin);
        $cnt = 1;

        return $this->template->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
    }

    public function changePassword()
    {
        $this->authenticated();

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

        return $this->template->render('change_password', compact('alogin','msg', 'error'));
    }

    public function edit()
    {
        $editid = null;
        $msg = null;
        $get = $this->request->getQueryParams();

        if(isset($get['edit'])) {
            $editid = $get['edit'];
        }


        if($this->request->getMethod() === 'POST') {
            $this->transaction->submitEdit();
            $msg = "Information Updated Successfully";
        }

        $result = $this->transaction->findByUserId($editid);

        // Render a template
        echo $this->template->render('edit-user', compact('result','editid', 'cnt', 'msg'));
    }
}