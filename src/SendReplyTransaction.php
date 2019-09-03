<?php


namespace Application;


class SendReplyTransaction
{
    private $notificationGateway;
    private $feedbackGateway;

    public function __construct(NotificationGateway $notificationGateway, FeedbackGateway $feedbackGateway)
    {
        $this->notificationGateway = $notificationGateway;
        $this->feedbackGateway = $feedbackGateway;
    }

    public function notifyAdmin($reciver, $message)
    {
        $notitype = 'Send Message';
        $sender = 'Admin';
        $this->notificationGateway->insertUserReciverType($sender, $reciver, $notitype);
        $this->feedbackGateway->insertByUserReciverDescription($sender, $reciver, $message);
    }
}