<?php


namespace Application\Controllers;


use Application\LoginTransaction;
use Application\Request;
use Application\TemplateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController
{
    private $request;
    private $transaction;
    private $template;

    public function __construct(ServerRequestInterface $request, LoginTransaction $transaction, TemplateInterface $template)
    {
        $this->request = $request;
        $this->transaction = $transaction;
        $this->template = $template;
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

        // Render a template
        echo $this->template->render('home', compact('redirect'));
    }
}