<?php


namespace App\Controller;

use App\Gateway\UsersGateway;
use App\PlatesTemplate;
use App\RendererInterface;
use App\Repository\AdminTransaction;
use App\Transaction\LoginTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends AbstractController
{
    private $transaction;

    public function __construct()
    {
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        $redirect = null;
        // Render a renderer
        return $this->render('home', compact('redirect'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        $redirect = false;
        $post = $request->request->all();
        $transaction = new LoginTransaction(new UsersGateway(get_database()));
        if ($transaction->authenticate($post['username'], $post['password'])) {
            $session = \App\Session::getSession();
            $session->set('alogin', $post['username']);
            $redirect = true;
        }

        return $this->render('home', compact('redirect'));
    }
}