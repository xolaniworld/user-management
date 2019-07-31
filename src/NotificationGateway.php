<?php
namespace Application;

use PDO;

class NotificationGateway
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertUserReciverType($user, $notireciver, $notitype)
    {
        $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynoti = $this->pdo->prepare($sqlnoti);
        $querynoti-> bindParam(':notiuser', $user, PDO::PARAM_STR);
        $querynoti-> bindParam(':notireciver', $notireciver, PDO::PARAM_STR);
        $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();
    }
}