<?php


namespace App\Controller;

use App\Gateway\FeedbackGateway;
use App\Gateway\UsersGateway;
use App\RendererInterface;
use App\Transaction\FeedbackTransaction;
use App\Transaction\Filesystem;
use App\Transaction\UsersTransactions;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class AdminFeedbackController extends AbstractController
{
    private $usersTransaction;
    private $feedbackTransaction;
    private $request;
    private $renderer;

    public function __construct()
    {
        $userGateway = new UsersGateway(get_database());
        $request = new \App\Request();
        $filesystem = new Filesystem(IMAGES_DIR);
        $feedbackTransaction = new FeedbackTransaction(new FeedbackGateway(get_database()));

        $this->usersTransaction = new UsersTransactions(new UsersGateway(get_database()), $request, $filesystem);
        $this->feedbackTransaction = $feedbackTransaction;

        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);

//        $usersTransaction = new Transaction\UsersTransactions($userGateway, $request, $filesystem);
//        $feedbackGateway = new Gateway\FeedbackGateway(get_database());
//        $feedbackTransaction = new Transaction\FeedbackTransaction($feedbackGateway);
//        return new Controller\AdminFeedbackController($usersTransaction, $feedbackTransaction, $this->getRequest(), $this->getRenderer());
    }

    public function feedback()
    {
        $this->authenticated();

        $msg = null;
        $get = $this->request->getQueryParams();

        if (isset($get['del'])) {
            $this->usersTransaction->deleteUserById();
            $msg = "Data Deleted successfully";
        }

        if (isset($get['unconfirm'])) {
            $this->usersTransaction->updateStatusUnConfirmed();

            $msg = "Changes Sucessfully";
        }

        if (isset($get['confirm'])) {
            $this->usersTransaction->updateStatusConfirmed();

            $msg = "Changes Sucessfully";
        }

        $this->feedbackTransaction->findAdmin();
        $results = $this->feedbackTransaction->getFeedback();
        $count = $this->feedbackTransaction->getTotal();
        $cnt = 1;

        return $this->render('admin/feedback', compact('msg', 'results', 'count', 'cnt'));
    }
}