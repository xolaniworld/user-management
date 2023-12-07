<?php

namespace UserManagement;
use PDO;
class NotificationRepository extends AbstractRepository
{
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