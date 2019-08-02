<?php


namespace Application;


use PDO;

class DeletedUserGateway extends AbstractGateway
{
    public function countById()
    {
        $sql6 = "SELECT id from deleteduser ";
        $query6 = $this->pdo->prepare($sql6);;
        $query6->execute();
        $results6 = $query6->fetchAll(PDO::FETCH_OBJ);
        $query = $query6->rowCount();

        return $query;
    }

    public function insertByName($name)
    {
        $sql2 = "insert into deleteduser (email) values (:name)";
        $query2 = $this->pdo->prepare($sql2);
        $query2->bindParam(':name', $name, PDO::PARAM_STR);
        $query2->execute();
    }
}