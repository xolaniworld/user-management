<?php


namespace Application\Transactions;


use Application\Gateways\DeletedUserGateway;

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