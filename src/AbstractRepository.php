<?php

namespace UserManagement;

use PHPUnit\Util\Exception;

class AbstractRepository
{
    protected $dbh;
    protected $results = null;
    protected $rowCount = null;
    protected $executed = false;
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getResults()
    {
        if ($this->results === null) {
            throw new ResultsNullException("Results Cannot Be Null");
        }
        return $this->results;
    }

    public function getRowCount()
    {
        if ($this->rowCount === null) {
            throw new RowCountNullException("Results Cannot Be Null");
        }
        return $this->rowCount;
    }
}

class ResultsNullException extends \Exception {}

class RowCountNullException extends \Exception {}