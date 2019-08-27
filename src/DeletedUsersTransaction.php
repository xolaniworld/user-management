<?php


namespace Application;


class DeletedUsersTransaction
{
    private $deletedUserGateway;

    public function __construct(DeletedUserGateway $deletedUserGateway)
    {
        $this->deletedUserGateway = $deletedUserGateway;
    }

    public function findAllDeletedUsers()
    {
       return  $this->deletedUserGateway->findAll();
    }
}