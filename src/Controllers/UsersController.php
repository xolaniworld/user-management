<?php


namespace Application\Controllers;


use Application\PlatesTemplate;
use Application\Session;
use Application\Users\UsersTransactions;
use Psr\Http\Message\ServerRequestInterface;

class UsersController
{
    private $request;
    private $transactions;
    private $template;

    public function __construct(ServerRequestInterface $request, UsersTransactions $transaction, PlatesTemplate $template)
    {
        $this->request = $request;
        $this->transaction = $transaction;
        $this->template = $template;
    }

    public function profile(\Symfony\Component\HttpFoundation\Session\Session $session)
    {
        $msg = null;
        if (isset($_POST['submit'])) {
            $this->transaction->submitEditFrontEnd();
            $msg = "Information Updated Successfully";
        }

        $alogin = $session->get('alogin');
        $result = $this->transaction->findByEmail($alogin);
        $cnt = 1;

        echo $this->template->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
    }

}