<?php
namespace Application\Controllers\Admin;

use Application\Controllers\AbstractController;
use Application\RendererInterface;
use Application\UserListTransaction;
use Psr\Http\Message\ServerRequestInterface;

class UserListController extends AbstractController
{
    private $transaction;
    private $request;
    private $renderer;

    public function __construct(UserListTransaction $transaction, RendererInterface $renderer, ServerRequestInterface $request)
    {
        $this->transaction = $transaction;
        $this->renderer = $renderer;
        $this->request = $request;
    }

    public function all()
    {
        $this->authenticated();

        $get = $this->request->getQueryParams();

        if (isset($get['del']) && isset($get['name'])) {
            $id = $get['del'];
            $name = $get['name'];
            $this->transaction->deleteUserAndUpdateDeletedUsers($id, $name);
            $msg = "Data Deleted successfully";
        }

        if (isset($_REQUEST['unconfirm'])) {
            $this->transaction->userConfirmed($get['unconfirm']);
            $msg = "Changes Sucessfully";
        }

        if (isset($_REQUEST['confirm'])) {
            $this->transaction->userUnconfirmed($get['confirm']);
            $msg = "Changes Sucessfully";
        }

        list($results, $rowCount) = $this->transaction->findAllUsers();

        return $this->renderer->render('admin/userlist', compact('results', 'rowCount', 'msg'));
    }
}