<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Gateway\AdminGateway;
use App\Model\Admin;
use App\PlatesTemplate;
use App\RendererInterface;
use App\Repository\AdminTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends AbstractController
{
    private $transaction;
    private $request;
    private $session;
    private $renderer;
    private $model;

    public function __construct()
    {
        $this->transaction = new AdminTransaction(new AdminGateway(get_database()));
        $this->renderer = new PlatesTemplate(__DIR__ . '/../../templates');
        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
        $this->session = \App\Session::getSession();

//        return new AdminController($t, $this->getRequest(), $this->getSession(), $this->getRenderer());
//        $this->transaction = new AdminTransaction();
//        $this->request = $request;
//        $this->session = $session;
//        $this->renderer = $renderer;
        $this->model = new Admin();
    }

    public function index()
    {
        $redirect = null;
        return $this->render('admin/index', compact('redirect'));
    }

    /**
     * @return mixed
     */
    public function login(): mixed
    {
        $input = $this->request->getParsedBody();
        $redirect = $this->model->login($input['username'], $input['password']);
        $this->session->set('alogin', $input['username']);
        // Render a template
        return $this->render('admin/index', compact('redirect'));
    }

    public function changePassword()
    {
        $this->authenticated();

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

        return $this->render('admin/change-password', compact('msg', 'error'));
    }

    public function profile()
    {
        $this->authenticated();
        $name = $email = $msg = '';

        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();

            $this->transaction->submitUpdateAdminUpdateUsernameAndPassword($input['name'], $input['email']);
            $msg = "Information Updated Successfully";
        }

        $result = $this->transaction->getAll();
        $cnt = 1;

        return $this->render('admin/profile', compact('result', 'cnt', 'name', 'email', 'msg'));
    }
}