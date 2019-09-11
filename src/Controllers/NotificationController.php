<?php

namespace Application\Controllers;

use Application\NotificationTransaction;
use Application\RendererInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class NotificationController
{
    private $transaction;
    private $renderer;
    private $session;

    public function __construct(NotificationTransaction $transaction, RendererInterface $renderer, Session $session)
    {
        $this->transaction =  $transaction;
        $this->renderer = $renderer;
        $this->session = $session;
    }

    public function notification()
    {
        $reciver = $this->session->get('alogin');

        $this->transaction->findNotificationsByReciver($reciver);

        // Render a template
        echo $this->renderer->render('notification', [
            'alogin' => $reciver,
            'results' => $this->transaction->getNotications(),
            'count' => $this->transaction->getTotal(),
            'cnt' => 1
        ]);
    }
}