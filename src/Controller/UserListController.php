<?php
namespace App\Controller;

use App\Gateway\DeletedUserGateway;
use App\Gateway\UsersGateway;
use App\RendererInterface;
use App\Transaction\UserListTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class UserListController extends AbstractController
{
    private $transaction;
    private $request;
    private $renderer;

    public function __construct(
//        UserListTransaction $transaction, RendererInterface $renderer, ServerRequestInterface $request
    )
    {
        $this->transaction = new UserListTransaction(
            new UsersGateway(get_database()),
            new DeletedUserGateway(get_database())
        );

        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
    }

    public function all()
    {
        $this->authenticated();

        $get = $this->request->getQueryParams();
        $msg = "";

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

        return $this->render('admin/userlist', compact('results', 'rowCount', 'msg'));
    }
}