<?php


namespace Application\Controllers;


use Application\LoginTransaction;
use Application\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController
{
    private $request;
    private $transaction;
    private $renderer;

    public function __construct(ServerRequestInterface $request, LoginTransaction $transaction, RendererInterface $renderer)
    {
        $this->request = $request;
        $this->transaction = $transaction;
        $this->renderer = $renderer;
    }

    public function home(Session $session)
    {
        $redirect = null;

        if ($this->request->getMethod() === 'POST') {
            $post = $this->request->getParsedBody();
            $this->transaction->submitLogin($post['username'], $post['password']);

            $redirect = false;

            if ($this->transaction->submitLogin($post['username'], $post['password'])) {
                $session->set('alogin', $post['username']);
                $redirect = true;
            }
        }

        // Render a renderer
        echo $this->renderer->render('home', compact('redirect'));
    }
}