<?php

namespace UserManagement;
use PDO;
class DeletedUserRepository extends AbstractRepository
{
    public function count()
    {
        $sql6 ="SELECT id from deleteduser ";
        $query6 = $this->dbh -> prepare($sql6);;
        $query6->execute();
        $this->results=$query6->fetchAll(PDO::FETCH_OBJ);
        return $query6->rowCount();
    }
}