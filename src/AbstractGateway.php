<?php

namespace Application;

use PDO;

abstract class AbstractGateway
{
    protected $pdo;
    protected $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
            throw new Exception('table required');
        }

        $sth = $this->pdo->prepare("insert into {$this->table} ({$fields}) values({$values})");

        $sth->execute($data);
    }

    private function getFields(array $array)
    {
        return implode(', ', array_keys($array));
    }
}