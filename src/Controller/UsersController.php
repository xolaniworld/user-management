<?php


namespace App\Controller;

use App\Auth;
use App\Gateway\UsersGateway;
use App\PlatesTemplate;
use App\Transaction\Filesystem;
use App\Transaction\UsersTransactions;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Session\Session;

class UsersController extends AbstractController
{
    private $request;
    private $transaction;
    private $session;
    private $template;

    public function __construct()
    {
        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
        $this->transaction = new UsersTransactions(
            new UsersGateway(get_database()),
            new \App\Request(),
            new Filesystem(IMAGES_DIR)
        );
        $this->session = \App\Session::getSession();
    }

    public function profile()
    {
        $this->authenticated();

        $email = $alogin = $cnt = $msg = '';
        if ($this->request->getMethod() === 'POST') {
            $this->transaction->submitEditFrontEnd();
            $msg = "Information Updated Successfully";
        }

        $alogin = $this->session->get('alogin');
        $result = $this->transaction->findByEmail($alogin);
        $cnt = 1;

        return $this->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
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