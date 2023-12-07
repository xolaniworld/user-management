<?php

namespace UserManagement;

class AbstractRepository
{
    protected $dbh;
    protected $results;
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getResults()
    {
        return $this->results;
    }
}