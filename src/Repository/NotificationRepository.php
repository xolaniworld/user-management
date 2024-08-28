<?php

namespace App\Repository;
use PDO;

class NotificationRepository extends AbstractRepository
{
    public function countByReceiver($receiver)
    {
        $sql12 ="SELECT id from notification where notireceiver = (:receiver)";
        $query12 = $this->dbh -> prepare($sql12);;
        $query12-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query12->execute();
        $this->results=$query12->fetchAll(PDO::FETCH_OBJ);
        return $query12->rowCount();
    }

    public function selectAllByReceiver($receiver)
    {
        $receiver = $_SESSION['alogin'];
        $sql = "SELECT * from  notification where notireceiver = (:receiver) order by time DESC";
        $query = $this->dbh -> prepare($sql);
        $query-> bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $query->execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $this->results;
    }
    public function insert($sender, $receiver, $notitype)
    {
        $sqlnoti="insert into notification (notiuser,notireceiver,notitype) values (:notiuser,:notireceiver,:notitype)";
        $querynoti = $this->dbh->prepare($sqlnoti);
        $querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
        $querynoti-> bindParam(':notireceiver',$receiver, PDO::PARAM_STR);
        $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();
    }
}