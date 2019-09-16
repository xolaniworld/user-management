<?php


namespace Application\Controllers\Admin;


use Application\Admin\AdminTransaction;
use Application\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController
{
    private $transaction;
    private $request;
    private $session;
    private $renderer;

    public function __construct(AdminTransaction $transaction, ServerRequestInterface $request, Session $session, RendererInterface $renderer)
    {
        $this->transaction = $transaction;
        $this->request = $request;
        $this->session = $session;
        $this->renderer = $renderer;
    }

    public function login()
    {
        $redirect = null;

        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();
            $redirect = $this->transaction->submitLogin($input['username'], $input['password']);
            $this->session->set('alogin', $input['username']);
        }

        // Render a template
        echo $this->renderer->render('admin/index', compact('redirect'));
    }

    public function changePassword()
    {
        $msg = null;
        $error = null;

        if($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();
            if ($this->transaction->submitChangePassword($this->session->set('alogin'), $input['password'], $input['newpassword'])) {
                $msg = "Your Password succesfully changed";
            } else {
                $error =  "Your current password is not valid.";
            }
        }

        echo $this->renderer->render('admin/change-password', compact('msg', 'error'));
    }

    public function profile()
    {
        $msg = null;
        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();

            $this->transaction->submitUpdateAdminUpdateUsernameAndPassword($input['name'], $input['email']);
            $msg = "Information Updated Successfully";
        }

        $result = $this->transaction->getAll();
        $cnt = 1;

        echo $this->renderer->render('admin/profile', compact('result', 'cnt', 'name', 'email', 'msg'));
    }
}