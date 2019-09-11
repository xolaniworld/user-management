<?php


namespace Application;

use Application\Controllers\FeedbackController;
use Application\Filesystem;
use Application\PlatesTemplate;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Application\Session;
use Symfony\Component\HttpFoundation\Request;
use Application\UsersGateway;
use Application\Controllers\NotificationController;

class ControllerFactory
{
    private $database;
    private $renderer;
    private $session;
    private $request;

    public function makeMainController()
    {
        $usersGateway = new \Application\UsersGateway($this->getDatabase());
        $transaction = new \Application\LoginTransaction($usersGateway);

        return new \Application\Controllers\MainController($this->getRequest(), $transaction, $this->getRenderer(), $this->getSession());
    }

    public function makeUserController()
    {
        $userGateway = new \Application\UsersGateway($this->getDatabase());
        $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new Filesystem(IMAGES_DIR));

        return new \Application\Controllers\UsersController(
            $this->getRequest(),
            $usersTransaction,
            $this->getRenderer(),
            $this->getSession()
        );
    }

    public function makeNotificationController()
    {
        $gateway = new NotificationGateway($this->getDatabase());
        $transaction = new NotificationTransaction($gateway);
        return new NotificationController($transaction, $this->getRenderer(), $this->getSession());
    }

    public function makeFeedbackController()
    {
        $notification = new NotificationGateway($this->getDatabase());
        $feedback = new FeedbackGateway($this->database);
        $users = new \Application\UsersGateway($this->database);
        $filesystem = new Filesystem(IMAGES_DIR);

        return new FeedbackController(
            new FrontendFeedbackTransaction($feedback, $notification, $users, $filesystem),
            $this->getRenderer(),
            $this->getRequest(),
            $this->getSession()
        );
    }

    private function getDatabase()
    {
        if ($this->database === null) {
            $this->database = get_database();
        }

        return $this->database;
    }

    private function getSession()
    {
        if ($this->session === null) {
            $this->session = \Application\Session::getSession();
        }

        return $this->session;
    }

    private function getRenderer()
    {
        if ($this->renderer === null) {
            $this->renderer = new PlatesTemplate(TEMPLATES_DIR);
        }

        return $this->renderer;
    }

    private function getRequest()
    {
        if ($this->request === null) {
            $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
            $psr17Factory = new Psr17Factory();
            $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
            $this->request = $psrHttpFactory->createRequest($symfonyRequest);
        }

        return $this->request;
    }
}