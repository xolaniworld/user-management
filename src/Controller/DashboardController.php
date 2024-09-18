<?php


namespace App\Controller;


use App\Gateway\DeletedUserGateway;
use App\Gateway\FeedbackGateway;
use App\Gateway\NotificationGateway;
use App\Gateway\UsersGateway;
use App\RendererInterface;
use App\Repository\DashboardTransaction;

class DashboardController extends AbstractController
{
    private $transaction;
    private $renderer;

    public function __construct()
    {
        $this->transaction = new DashboardTransaction(
            new UsersGateway(get_database()),
            new FeedbackGateway(get_database()),
            new NotificationGateway(get_database()),
            new DeletedUserGateway(get_database())
        );
    }

    public function dashboard()
    {
        $this->authenticated();

        list($bg, $regbd, $regbd2, $query) = $this->transaction->dashboard();

        // Render a template
        return $this->render('dashboard', compact('bg','regbd', 'regbd2', 'query'));
    }
}