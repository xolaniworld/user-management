<?php

namespace App\Gateways;

use PDO;

abstract class AbstractGateway
{
    protected $pdo;
    protected $table = null;
    protected $fields;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll()
    {
        if ($this->table === null) {
            throw new \Exception('$table required');
        }
        $sql = "select * from {$this->table};";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    protected function insert(array $data)
    {
        $values = [];
        $fields = [];
        foreach ($data as $field => $value) {
            $fields[] = $field;
            $values[] = ":$field";
        }
        $fields = implode(', ', $fields);
        $values = implode(', ', $values);

        if ($this->table === null) {
            throw new \Exception('table required');
        }

        $sth = $this->pdo->prepare("insert into {$this->table}({$fields}) values({$values})");

        return $sth->execute($data);
    }
}