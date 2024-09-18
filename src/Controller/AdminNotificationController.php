<?php


namespace App\Controller;

use App\Gateway\AdminGateway;
use App\Gateway\NotificationGateway;
use App\RendererInterface;
use App\Repository\AdminTransaction;
use App\Transaction\NotificationTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class AdminNotificationController extends AbstractController
{
    private $notificationTransaction;
    private $adminTransaction;
    private $renderer;
    private $request;

    public function __construct(NotificationTransaction $notificationTransaction, AdminTransaction $adminTransaction, RendererInterface $renderer, ServerRequestInterface $request)
    {
        $this->notificationTransaction =  new NotificationTransaction(new NotificationGateway(get_database()));
        $this->adminTransaction = new AdminTransaction( new AdminGateway(get_database()));

        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
    }

    public function notification()
    {
        $this->authenticated();

        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();
            $this->adminTransaction->submitUpdateAdminUpdateUsernameAndPassword(
                $input['name'],
                $input['email']
            );
            $msg = "Information Updated Successfully";
        }
        $this->notificationTransaction->findAdminNotifications();
        $results = $this->notificationTransaction->getNotications();
        $count = $this->notificationTransaction->getTotal();
        $cnt = 1;

        return $this->render('admin/notification', compact('results', 'count', 'cnt'));
    }
}