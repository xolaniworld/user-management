<?php


namespace App\Transaction;


use App\Gateway\FeedbackGateway;

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
        $receiver = 'Admin';
        list($this->feedback, $this->total) = $this->feedbackGateway->findByreceiver($receiver);
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