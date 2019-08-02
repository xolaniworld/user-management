<?php


namespace Application;


use PDO;

class DeletedUserGateway extends AbstractGateway
{
    public function countById()
    {
        $sql6 ="SELECT id from deleteduser ";
        $query6 = $this->pdo -> prepare($sql6);;
        $query6->execute();
        $results6=$query6->fetchAll(PDO::FETCH_OBJ);
        $query=$query6->rowCount();

        return $query;
    }
}