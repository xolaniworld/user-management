<?php


namespace Application\Controllers;


use Application\FrontendFeedbackTransaction;
use Application\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FeedbackController
{
    private $transaction;
    private $session;
    private $request;
    private $renderer;

    public function __construct(FrontendFeedbackTransaction $transaction, RendererInterface $renderer, ServerRequestInterface $request, Session $session)
    {
        $this->transaction = $transaction;
        $this->session = $session;
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function frontend()
    {
        $msg = null;
        $alogin = $this->session->get('alogin');

        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getParsedBody();
            $this->transaction->submitFeedback($input['title'], $input['description'], $alogin, $_FILES['attachment']);
            $msg = "Feedback Send";
        }

        $result = $this->transaction->getAllUsers();
        $cnt = 1;

        // Render a template
        echo $this->renderer->render('feedback', [
            'alogin' => $alogin,
            'msg' => $msg,
            'cnt' => $cnt,
            'result' => $result
        ]);
    }

    public function messages()
    {
        $alogin = $this->session->get('alogin');
        list($results, $count) = $this->transaction->getAllByReciver($alogin);
        $cnt = 1;
        // Render a template
        echo $this->renderer->render('messages', compact('alogin', 'results', 'count', 'cnt'));
    }
}