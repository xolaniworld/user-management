<?php


namespace Application\Admin;
use Application\Response;
use Application\Session;

abstract class AbstractAdminTransaction
{
    protected $session;
    protected $response;

    public function __construct(Response $response, Session $session)
    {
        $this->response = $response;
        $this->session = $session;
    }

    protected function checkLogin()
    {
        if ($this->session->get('alogin') === 0) {
            $this->response->redirect('index.php');
        }
    }
}