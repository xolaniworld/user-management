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
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends AbstractController
{
    private $request;
    private $transaction;
    private $renderer;
    private $session;

    public function __construct(
//        ServerRequestInterface $request, LoginTransaction $transaction, RendererInterface $renderer, Session $session
    )
    {
        $this->transaction = new LoginTransaction(new UsersGateway(get_database()));
        $this->renderer = new PlatesTemplate(__DIR__ . '/../../templates');
        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
        $this->session = \App\Session::getSession();
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login()
    {
        $redirect = false;
        $post = $this->request->getParsedBody();
        if ($this->transaction->authenticate($post['username'], $post['password'])) {
            $this->session->set('alogin', $post['username']);
            $redirect = true;
        }

        return $this->render('home', compact('redirect'));
    }
}