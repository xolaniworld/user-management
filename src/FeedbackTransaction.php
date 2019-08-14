<?php


namespace Application;


class FeedbackTransaction
{
    private $usersGateway;
    private $request;

    public function __construct(UsersGateway $usersGateway, Request $request)
    {
        $this->usersGateway = $usersGateway;
        $this->request = $request;
    }

    public function updateFeedback()
    {
        if ($this->request->queryIsset('del')) {
            $id = $this->getQuery('del');
            $this->userGateway->deleteById($id);
            $msg = "Data Deleted successfully";
        }

        if ($this->request->requestIsset('unconfirm')) {
            $aeid = intval($this->request->getQuery('unconfirm'));
            $memstatus = 1;
            $this->userGateway->updateStatusById($memstatus, $aeid);
            $msg = "Changes Sucessfully";
        }

        if (isset($_REQUEST['confirm'])) {
            $aeid = intval($this->request->getQuery('confirm'));
            $memstatus = 0;
            $this->userGateway->updateStatusById($memstatus, $aeid);
            $msg = "Changes Sucessfully";
        }

        return $msg;
    }
}