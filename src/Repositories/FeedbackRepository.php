<?php

namespace Application\Repositories;
use PDO;

class FeedbackRepository extends AbstractRepository
{
    public function countByReceiver($receiver)
    {
        $sql1 ="SELECT id from feedback where receiver = (:receiver)";
        $query1 = $this->dbh -> prepare($sql1);;
        $query1-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query1->execute();
        $this->results = $query1->fetchAll(PDO::FETCH_OBJ);
        return $query1->rowCount();
    }
    public function selectAllByReceiver($receiver)
    {
        $sql = "SELECT * from  feedback where receiver = (:receiver)";
        $query = $this->dbh -> prepare($sql);
        $query-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query->execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount() > 0;
    }
    public function insert($user, $receiver, $title, $description, $attachment)
    {
        $sql="insert into feedback (sender, receiver, title,feedbackdata,attachment) values (:user,:receiver,:title,:description,:attachment)";
        $query = $this->dbh->prepare($sql);
        $query-> bindParam(':user', $user, PDO::PARAM_STR);
        $query-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query-> bindParam(':title', $title, PDO::PARAM_STR);
        $query-> bindParam(':description', $description, PDO::PARAM_STR);
        $query-> bindParam(':attachment', $attachment, PDO::PARAM_STR);
        $query->execute();
    }
}