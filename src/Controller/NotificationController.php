<?php

namespace App\Controller;

use App\Auth;
use App\Gateway\NotificationGateway;
use App\RendererInterface;
use App\Transaction\NotificationTransaction;
use Symfony\Component\HttpFoundation\Session\Session;

class NotificationController extends AbstractController
{
    private $transaction;
    private $renderer;
    private $session;

    public function __construct()
    {
        $gateway = new NotificationGateway(get_database());
        $this->transaction =  new NotificationTransaction($gateway);
        $this->session = \App\Session::getSession();;
    }

    public function notification()
    {
        $this->authenticated();

        $receiver = $this->session->get('alogin');

        $this->transaction->findNotificationsByreceiver($receiver);

        // Render a template
        return $this->render('notification', [
            'alogin' => $receiver,
            'results' => $this->transaction->getNotications(),
            'count' => $this->transaction->getTotal(),
            'cnt' => 1
        ]);
    }
}