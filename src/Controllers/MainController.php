<?php


namespace Application\Controllers;


use Application\LoginTransaction;
use Application\Request;
use Application\TemplateInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

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

    public function home()
    {
        $redirect = null;
        if ($this->request->getMethod() === 'POST') {
            $post = $this->request->getParsedBody();
            $this->transaction->submitLogin($post['username'], $post['password']);
            if ($this->transaction->submitLogin($post['username'], $post['password'])) {
                $_SESSION['alogin'] = $post['username'];
                $redirect = true;
            } else {
                $redirect = false;
            }
        }

        // Render a template
        echo $this->template->render('home', compact('redirect'));
    }
}