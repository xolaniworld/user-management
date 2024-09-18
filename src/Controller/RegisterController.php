<?php


namespace App\Controller;


use App\Gateway\NotificationGateway;
use App\Gateway\UsersGateway;
use App\RendererInterface;
use App\Request;
use App\Transaction\Filesystem;
use App\Transaction\RegisterTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class RegisterController extends AbstractController
{
    private $transaction;
    private $renderer;
    private $request;
    public function __construct(
    //    RegisterTransaction $transaction,  RendererInterface $renderer, ServerRequestInterface $request
    )
    {
        $this->transaction = new RegisterTransaction(
            new UsersGateway(get_database()),
            new NotificationGateway(get_database()),
            new Filesystem(IMAGES_DIR),
            new \App\Request()
        );

        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
    }

    public function view()
    {
        $error = null;
        $redirect = false;
        return $this->render('register', compact('error', 'redirect'));
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
        return $this->render('register', compact('error', 'redirect'));
    }
}