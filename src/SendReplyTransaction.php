<?php


namespace Application;


class SendReplyTransaction
{
    private $notificationGateway;
    private $feedbackGateway;
    private $usersGateway;

    public function __construct(NotificationGateway $notificationGateway, FeedbackGateway $feedbackGateway, UsersGateway $usersGateway)
    {
        $this->notificationGateway = $notificationGateway;
        $this->feedbackGateway = $feedbackGateway;
        $this->usersGateway = $usersGateway;
    }

    public function notifyAdmin($reciver, $message)
    {
        $notitype = 'Send Message';
        $sender = 'Admin';
        $this->notificationGateway->insertUserReciverType($sender, $reciver, $notitype);
        $this->feedbackGateway->insertByUserReciverDescription($sender, $reciver, $message);
    }

    public function findAllUsers()
    {
        return $this->usersGateway->findAll();
    }
}