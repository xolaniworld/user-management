<?php


namespace Application;


use PDO;

class FeedbackGateway extends AbstractGateway
{
    protected $table = 'feedback';

    public function insertSenderReciverTitleFeedbackAttachment($user, $reciver, $title, $description, $attachment)
    {
        $this->insert([
            'sender' => $user,
            'reciver' => $reciver,
            'title' => $title,
            'feedbackdata' => $description,
            'attachment' => $attachment,
        ]);
    }

    public function countByReciver($reciver)
    {
        $sql1 = "SELECT id from feedback where reciver = (:reciver)";
        $query1 = $this->pdo->prepare($sql1);;
        $query1->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query1->execute();
        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
        return $query1->rowCount();
    }

    public function findByReciver($reciver)
    {
        $sql = "SELECT * from  feedback where reciver = (:reciver)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return [$results, $query->rowCount()];
    }

    public function insertByUserReciverDescription($sender, $reciver, $message)
    {
        $this->insert([
            'sender' => $sender,
            'reciver' => $reciver,
            'feedbackdata' => $message,
            'attachment' => '',
            'title' => ''
        ]);
    }
}