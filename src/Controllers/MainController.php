<?php


namespace App\Controllers;


use App\RendererInterface;
use App\Transactions\LoginTransaction;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController
{
    private $request;
    private $transaction;
    private $renderer;
    private $session;

    public function __construct(ServerRequestInterface $request, LoginTransaction $transaction, RendererInterface $renderer, Session $session)
    {
        $this->request = $request;
        $this->transaction = $transaction;
        $this->renderer = $renderer;
        $this->session = $session;
    }

    public function home()
    {
        $redirect = null;

        if ($this->request->getMethod() === 'POST') {
            $post = $this->request->getParsedBody();
            $this->transaction->submitLogin($post['username'], $post['password']);

            $redirect = false;

            if ($this->transaction->submitLogin($post['username'], $post['password'])) {
                $this->session->set('alogin', $post['username']);
                $redirect = true;
            }
        }

        // Render a renderer
        return $this->renderer->render('home', compact('redirect'));
    }
}