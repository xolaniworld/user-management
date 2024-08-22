<?php

namespace Application\Controllers;

use Application\Auth;
use Application\RendererInterface;
use Application\Transactions\NotificationTransaction;
use Symfony\Component\HttpFoundation\Session\Session;

class NotificationController extends AbstractController
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
        $this->authenticated();

        $receiver = $this->session->get('alogin');

        $this->transaction->findNotificationsByreceiver($receiver);

        // Render a template
        return $this->renderer->render('notification', [
            'alogin' => $receiver,
            'results' => $this->transaction->getNotications(),
            'count' => $this->transaction->getTotal(),
            'cnt' => 1
        ]);
    }
}