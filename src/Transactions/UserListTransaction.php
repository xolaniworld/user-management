<?php declare(strict_types=1);

namespace Application\Transactions;


use Application\Gateways\DeletedUserGateway;
use Application\Gateways\UsersGateway;

class UserListTransaction
{
    private $usersGateway;
    private $deletedUserGateway;

    public function __construct(UsersGateway $usersGateway, DeletedUserGateway $deletedUserGateway)
    {
        $this->usersGateway = $usersGateway;
        $this->deletedUserGateway = $deletedUserGateway;
    }

    public function findAllUsers()
    {
        return $this->usersGateway->findAllUsers();
    }

    public function deleteUserAndUpdateDeletedUsers($id, $name)
    {
        $this->usersGateway->deleteById($id);
        $this->deletedUserGateway->insertByName($name);
    }

    public function userUnconfirmed($aeid)
    {
        $aeid = intval($aeid);
        $memstatus = 1;
        $this->usersGateway->updateStatusById($memstatus, $aeid);
    }

    public function userConfirmed($aeid)
    {
        $aeid = intval($aeid);
        $memstatus = 0;
        $this->usersGateway->updateStatusById($memstatus, $aeid);
    }
}