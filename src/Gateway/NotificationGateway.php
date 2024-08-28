<?php
namespace App\Gateway;

use PDO;

class NotificationGateway extends AbstractGateway
{
    public function insertUserReceiverType($user, $notification_receiver, $notification_type)
    {
        $sqlnoti="insert into notifications (notification_user,notification_receiver,notification_type, time, created, updated) 
                values (:notification_user,:notification_receiver,:notification_type, now(), now(), now())";
        $querynoti = $this->pdo->prepare($sqlnoti);
        $querynoti-> bindParam(':notification_user', $user, PDO::PARAM_STR);
        $querynoti-> bindParam(':notification_receiver', $notification_receiver, PDO::PARAM_STR);
        $querynoti-> bindParam(':notification_type', $notification_type, PDO::PARAM_STR);
        $querynoti->execute();
    }

    public function countByReceiver($receiver)
    {
        $sql12 ="select id from notifications where notification_receiver = (:receiver)";
        $query12 = $this->pdo -> prepare($sql12);;
        $query12-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query12->execute();
        $results12=$query12->fetchAll(PDO::FETCH_OBJ);
        $regbd2=$query12->rowCount();

        return $regbd2;
    }

    public function findByNotiReceiver($receiver)
    {
        $sql = "select * from notifications where notification_receiver = (:receiver) order by time DESC";
        $query = $this->pdo -> prepare($sql);
        $query-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        return [$results, $query->rowCount()];
    }
}