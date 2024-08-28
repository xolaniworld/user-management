<?php


namespace App\Gateway;


use PDO;

class FeedbackGateway extends AbstractGateway
{
    protected $table = 'feedbacks';

    public function insertSenderReceiverTitleFeedbackAttachment($user, $receiver, $title, $description, $attachment)
    {
        return $this->insert([
            'sender' => $user,
            'receiver' => $receiver,
            'title' => $title,
            'feedback_data' => $description,
            'attachment' => $attachment,
        ]);
    }

    public function countByReceiver($receiver)
    {
        $sql1 = "select id from feedbacks where receiver = (:receiver)";
        $query1 = $this->pdo->prepare($sql1);;
        $query1->bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query1->execute();
        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
        return $query1->rowCount();
    }

    public function findByReceiver($receiver)
    {
        $sql = "select * from feedbacks where receiver = (:receiver)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return [$results, $query->rowCount()];
    }

    public function insertByUserReceiverDescription($sender, $receiver, $message)
    {
        $this->insert([
            'sender' => $sender,
            'receiver' => $receiver,
            'feedback_data' => $message,
            'attachment' => '',
            'title' => ''
        ]);
    }
}