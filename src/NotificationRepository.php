<?php

namespace UserManagement;
use PDO;
class NotificationRepository extends AbstractRepository
{
    public function countByReceiver($reciver)
    {
        $sql12 ="SELECT id from notification where notireciver = (:reciver)";
        $query12 = $this->dbh -> prepare($sql12);;
        $query12-> bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query12->execute();
        $this->results=$query12->fetchAll(PDO::FETCH_OBJ);
        return $query12->rowCount();
    }

    public function selectAllByReceiver($reciver)
    {
        $reciver = $_SESSION['alogin'];
        $sql = "SELECT * from  notification where notireciver = (:reciver) order by time DESC";
        $query = $this->dbh -> prepare($sql);
        $query-> bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $this->results;
    }
    public function insert($sender, $reciver, $notitype)
    {
        $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynoti = $this->dbh->prepare($sqlnoti);
        $querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
        $querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
        $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();
    }
}