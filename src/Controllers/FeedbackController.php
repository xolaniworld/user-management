<?php


namespace Application\Controllers;


use Application\Auth;
use Application\FrontendFeedbackTransaction;
use Application\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FeedbackController extends AbstractController
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
        $this->authenticated();

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
        return $this->renderer->render('feedback', [
            'alogin' => $alogin,
            'msg' => $msg,
            'cnt' => $cnt,
            'result' => $result
        ]);
    }

    public function messages()
    {
        $this->authenticated();

        $alogin = $this->session->get('alogin');
        list($results, $count) = $this->transaction->getAllByreceiver($alogin);
        $cnt = 1;
        // Render a template
        return $this->renderer->render('messages', compact('alogin', 'results', 'count', 'cnt'));
    }

    public function feedback()
    {

    }
}