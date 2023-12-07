<?php

namespace UserManagement;
use PDO;
class NotificationRepository extends AbstractRepository
{

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