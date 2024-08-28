<?php


namespace App\Controller;


use App\RendererInterface;
use App\Transaction\SendReplyTransaction;
use Psr\Http\Message\ServerRequestInterface;

class SendReplyController
{
    private $transaction;
    private $request;
    private $renderer;

    public function __construct(SendReplyTransaction $transaction, ServerRequestInterface $request, RendererInterface $renderer)
    {
        $this->transaction = $transaction;
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function sendReply()
    {
        $msg = null;
        $replyto = null;
        $get = $this->request->getQueryParams();

        if (isset($get['reply'])) {
            $replyto = $get['reply'];
        }

        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();

            $this->transaction->notifyAdmin($input['email'], $input['message']);
            $msg = "Feedback Send";
        }

        $result = $this->transaction->findAllUsers();
        $cnt = 1;

        echo $this->renderer->render('admin/sendreply', compact('result', 'cnt', 'msg', 'replyto'));
    }
}