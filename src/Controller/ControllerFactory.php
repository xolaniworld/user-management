<?php


namespace App\Controller;

use App\Controller;
use App\Gateway;
use App\Gateway\AdminGateway;
use App\Gateway\DeletedUserGateway;
use App\Gateway\FeedbackGateway;
use App\Gateway\NotificationGateway;
use App\Gateway\UsersGateway;
use App\PlatesTemplate;
use App\Repository\AdminTransaction;
use App\Repository\DashboardTransaction;
use App\Transaction;
use App\Transaction\Filesystem;
use App\Transaction\FrontendFeedbackTransaction;
use App\Transaction\NotificationTransaction;
use App\Transaction\RegisterTransaction;
use App\Transaction\UserListTransaction;
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

    public function makeUserController()
    {
        $userGateway = new Gateway\UsersGateway($this->getDatabase());
        $usersTransaction = new Transaction\UsersTransactions($userGateway, new \App\Request(), new Filesystem(IMAGES_DIR));

        return new \App\Controller\UsersController(
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
        $users = new Gateway\UsersGateway($this->database);
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
        $userGateway = new Gateway\UsersGateway($this->getDatabase());
        $request = new \App\Request();
        $filesystem = new Transaction\Filesystem(IMAGES_DIR);
        $usersTransaction = new Transaction\UsersTransactions($userGateway, $request, $filesystem);
        $feedbackGateway = new Gateway\FeedbackGateway(get_database());
        $feedbackTransaction = new Transaction\FeedbackTransaction($feedbackGateway);
        return new Controller\AdminFeedbackController($usersTransaction, $feedbackTransaction, $this->getRequest(), $this->getRenderer());
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
        return new Controller\AdminNotificationController(
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

    /**
     * @return mixed
     */
    private function getSession()
    {
        if ($this->session === null) {
            $this->session = \App\Session::getSession();
        }

        return $this->session;
    }

    /**
     * @return PlatesTemplate
     */
    private function getRenderer()
    {
        if ($this->renderer === null) {
            $this->renderer = new PlatesTemplate(__DIR__ . '/../../templates');
        }

        return $this->renderer;
    }

    /**
     * @return \Psr\Http\Message\ServerRequestInterface
     */
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