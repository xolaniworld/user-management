<?php


namespace Application;


class FeedbackTransaction
{
    private $feedbackGateway;
    private $feedback;
    private $total;

    public function __construct(FeedbackGateway $feedbackGateway)
    {
        $this->feedbackGateway = $feedbackGateway;
    }

    public function findAdmin()
    {
        $reciver = 'Admin';
        list($this->feedback, $this->total) = $this->feedbackGateway->findByReciver($reciver);
    }

    public function getFeedback()
    {
        return $this->feedback;
    }

    public function getTotal()
    {
        return $this->total;
    }
}