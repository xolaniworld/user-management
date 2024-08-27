<?php


namespace App\Controllers;

use App\Controllers;
use App\Gateways;
use App\Gateways\AdminGateway;
use App\Gateways\DeletedUserGateway;
use App\Gateways\FeedbackGateway;
use App\Gateways\NotificationGateway;
use App\Gateways\UsersGateway;
use App\PlatesTemplate;
use App\Repositories\AdminTransaction;
use App\Repositories\DashboardTransaction;
use App\Transactions;
use App\Transactions\Filesystem;
use App\Transactions\FrontendFeedbackTransaction;
use App\Transactions\NotificationTransaction;
use App\Transactions\RegisterTransaction;
use App\Transactions\UserListTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class ControllerFactory
{
    private $database;
    private $renderer;
    private $session;
    private $request;

    public function makeAdminController()
    {
        $t = new AdminTransaction(new AdminGateway($this->getDatabase()));
        return new AdminController($t, $this->getRequest(), $this->getSession(), $this->getRenderer());
    }

    public function makeMainController()
    {
        $usersGateway = new Gateways\UsersGateway($this->getDatabase());
        $transaction = new Transactions\LoginTransaction($usersGateway);
        return new \App\Controllers\MainController($this->getRequest(), $transaction, $this->getRenderer(), $this->getSession());
    }

    public function makeUserController()
    {
        $userGateway = new Gateways\UsersGateway($this->getDatabase());
        $usersTransaction = new Transactions\UsersTransactions($userGateway, new \App\Request(), new Filesystem(IMAGES_DIR));

        return new \App\Controllers\UsersController(
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
        $users = new Gateways\UsersGateway($this->database);
        $filesystem = new Filesystem(IMAGES_DIR);

        return new FeedbackController(
            new FrontendFeedbackTransaction($feedback, $notification, $users, $filesystem),
            $this->getRenderer(),
            $this->getRequest(),
            $this->getSession()
        );
    }

    public function makeAdminFeedbackController()
    {
        $userGateway = new Gateways\UsersGateway($this->getDatabase());
        $request = new \App\Request();
        $filesystem = new Transactions\Filesystem(IMAGES_DIR);
        $usersTransaction = new Transactions\UsersTransactions($userGateway, $request, $filesystem);
        $feedbackGateway = new Gateways\FeedbackGateway(get_database());
        $feedbackTransaction = new Transactions\FeedbackTransaction($feedbackGateway);
        return new Controllers\AdminFeedbackController($usersTransaction, $feedbackTransaction, $this->getRequest(), $this->getRenderer());
    }

    public function makeUserListController()
    {
        return new UserListController(
            new UserListTransaction(
                new UsersGateway($this->getDatabase()),
                new DeletedUserGateway($this->getDatabase())
            ),
            $this->getRenderer(),
            $this->getRequest()
        );
    }

    public function makeRegisterController()
    {
        return new RegisterController(
            new RegisterTransaction(
                new UsersGateway($this->getDatabase()),
                new NotificationGateway($this->getDatabase()),
                new Filesystem(IMAGES_DIR),
                new \App\Request()
            ),
            $this->getRenderer(),
            $this->getRequest()
        );
    }

    public function makeDashboardController()
    {
        return new DashboardController(
            new DashboardTransaction(
                new UsersGateway($this->getDatabase()),
                new FeedbackGateway($this->getDatabase()),
                new NotificationGateway($this->getDatabase()),
                new DeletedUserGateway($this->getDatabase())
            ),
            $this->getRenderer()
        );
    }

    public function makeAdminNotificationController()
    {
        return new Controllers\AdminNotificationController(
            new NotificationTransaction(new NotificationGateway($this->getDatabase())),
            new AdminTransaction( new AdminGateway($this->getDatabase())),
            $this->getRenderer(), $this->getRequest()
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
            $this->session = \App\Session::getSession();
        }

        return $this->session;
    }

    private function getRenderer()
    {
        if ($this->renderer === null) {
            $this->renderer = new PlatesTemplate(__DIR__ . '/../../templates');
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