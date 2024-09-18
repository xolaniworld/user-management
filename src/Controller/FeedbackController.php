<?php


namespace App\Controller;


use App\Auth;
use App\Gateway\FeedbackGateway;
use App\Gateway\NotificationGateway;
use App\Gateway\UsersGateway;
use App\RendererInterface;
use App\Transaction\Filesystem;
use App\Transaction\FrontendFeedbackTransaction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Session\Session;

class FeedbackController extends AbstractController
{
    private $transaction;
    private $session;
    private $request;
    private $renderer;

    public function __construct()
    {
        $notification = new NotificationGateway(get_database());
        $feedback = new FeedbackGateway(get_database());
        $users = new UsersGateway(get_database());
        $filesystem = new Filesystem(IMAGES_DIR);

        $this->transaction = new FrontendFeedbackTransaction($feedback, $notification, $users, $filesystem);
        $this->session = \App\Session::getSession();

        $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->request = $psrHttpFactory->createRequest($symfonyRequest);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
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
        return $this->render('feedback', [
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
        return $this->render('messages', compact('alogin', 'results', 'count', 'cnt'));
    }

    public function feedback()
    {

    }
}