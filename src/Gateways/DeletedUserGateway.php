<?php


namespace Application\Gateways;


use PDO;

class DeletedUserGateway extends AbstractGateway
{
    protected $table = 'deleted_user';

    public function countById()
    {
        $sql6 = "select id from deleted_users ";
        $query6 = $this->pdo->prepare($sql6);;
        $query6->execute();
        $results6 = $query6->fetchAll(PDO::FETCH_OBJ);
        $query = $query6->rowCount();

        return $query;
    }

    public function insertByName($name)
    {
        $this->insert(['email' => $name]);
    }

    public function findAll()
    {
        $sql = "SELECT * from deleted_users";
        $query = $this->pdo -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        return [$results, $query->rowCount()];
    }
}