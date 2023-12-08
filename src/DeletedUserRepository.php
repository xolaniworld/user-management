<?php

namespace UserManagement;
use PDO;
class DeletedUserRepository extends AbstractRepository
{
    public function insert($name)
    {
        $sql2 = "insert into deleteduser (email) values (:name)";
        $query2 = $this->dbh->prepare($sql2);
        $query2 -> bindParam(':name',$name, PDO::PARAM_STR);
        $query2 -> execute();
    }
    public function count()
    {
        $sql6 ="SELECT id from deleteduser ";
        $query6 = $this->dbh -> prepare($sql6);;
        $query6->execute();
        $this->results=$query6->fetchAll(PDO::FETCH_OBJ);
        return $query6->rowCount();
    }

    public function selectAll()
    {
        $sql = "SELECT * from  deleteduser";
        $query = $this->dbh -> prepare($sql);
        $this->executed = $query->execute();
        $this->results = $query->fetchAll(PDO::FETCH_OBJ);
        $this->rowCount = $query->rowCount();
        return $this;
    }
}