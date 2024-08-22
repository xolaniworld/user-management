<?php
namespace Application\Repositories;

use Application\Gateways\DeletedUserGateway;
use Application\Gateways\FeedbackGateway;
use Application\Gateways\NotificationGateway;
use Application\Gateways\UsersGateway;

class DashboardTransaction
{
    private $usersGateway;
    private $feedbackGateway;
    private $notificationGateway;
    private $deletedUserGateway;

    public function __construct(UsersGateway $usersGateway, FeedbackGateway $feedbackGateway, NotificationGateway $notificationGateway, DeletedUserGateway $deletedUserGateway)
    {
        $this->usersGateway = $usersGateway;
        $this->feedbackGateway = $feedbackGateway;
        $this->notificationGateway = $notificationGateway;
        $this->deletedUserGateway = $deletedUserGateway;
    }

    public function dashboard()
    {
        $bg = $this->usersGateway->countIds();
        $receiver = 'Admin';
        $regbd = $this->feedbackGateway->countByreceiver($receiver);
        $regbd2 = $this->notificationGateway->countByreceiver($receiver);

        $query = $this->deletedUserGateway->countById();

        return [$bg, $regbd, $regbd2, $query];
    }
}