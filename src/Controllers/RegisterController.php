<?php


namespace App\Controllers;


use App\RendererInterface;
use App\Transactions\RegisterTransaction;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController
{
    private $transaction;
    private $renderer;
    private $request;
    public function __construct(RegisterTransaction $transaction,  RendererInterface $renderer, ServerRequestInterface $request)
    {
        $this->transaction = $transaction;
        $this->renderer = $renderer;
        $this->request = $request;
    }

    public function register()
    {
        $error = null;
        $redirect = false;

        if ($this->request->getMethod() === 'POST') {
            $success = $this->transaction->submitRegister();

            if ($success) {
                $redirect = true;
            } else {
                $error = "Something went wrong. Please try again";
            }
        }

        // Render a template
        return $this->renderer->render('register', compact('error', 'redirect'));
    }
}