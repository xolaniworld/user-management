<?php


namespace Application\Controllers\Admin;

use Application\Controllers\AbstractController;
use Application\NotificationTransaction;
use Application\Admin\AdminTransaction;
use Application\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotificationController extends AbstractController
{
    private $notificationTransaction;
    private $adminTransaction;
    private $renderer;
    private $request;

    public function __construct(NotificationTransaction $notificationTransaction, AdminTransaction $adminTransaction, RendererInterface $renderer, ServerRequestInterface $request)
    {
        $this->notificationTransaction = $notificationTransaction;
        $this->adminTransaction = $adminTransaction;
        $this->renderer = $renderer;
        $this->request = $request;
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

        return $this->renderer->render('admin/notification', compact('results', 'count', 'cnt'));
    }
}