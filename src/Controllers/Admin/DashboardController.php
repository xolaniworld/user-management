<?php


namespace Application\Controllers\Admin;


use Application\Controllers\AbstractController;
use Application\RendererInterface;
use Application\Repositories\DashboardTransaction;

class DashboardController extends AbstractController
{
    private $transaction;
    private $renderer;

    public function __construct(DashboardTransaction $transaction, RendererInterface $renderer)
    {
        $this->transaction = $transaction;
        $this->renderer = $renderer;
    }

    public function dashboard()
    {
        $this->authenticated();

        list($bg, $regbd, $regbd2, $query) = $this->transaction->dashboard();

        // Render a template
        return $this->renderer->render('dashboard', compact('bg','regbd', 'regbd2', 'query'));
    }
}