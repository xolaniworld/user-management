<?php


namespace Application\Transactions;


use Application\Gateways\NotificationGateway;

class NotificationTransaction
{
    private $notificationGateway;
    private $notifications;
    private $total;

    public function __construct(NotificationGateway $notificationGateway)
    {
        $this->notificationGateway = $notificationGateway;
    }

    public function findAdminNotifications()
    {
        $receiver = 'Admin';
        $this->findNotificationsByreceiver($receiver);

        return $this;
    }

    public function findNotificationsByreceiver($receiver)
    {
        list($this->notifications , $this->total) = $this->notificationGateway->findByNotireceiver($receiver);
    }

    public function getNotications()
    {
        return $this->notifications;
    }

    public function getTotal()
    {
        return $this->total;
    }
}