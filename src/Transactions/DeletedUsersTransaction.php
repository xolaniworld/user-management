<?php


namespace App\Transactions;


use App\Gateways\DeletedUserGateway;

class DeletedUsersTransaction
{
    private $deletedUserGateway;

    public function __construct(DeletedUserGateway $deletedUserGateway)
    {
        $this->deletedUserGateway = $deletedUserGateway;
    }

    public function findAllDeletedUsers()
    {
       return $this->deletedUserGateway->findAll();
    }
}