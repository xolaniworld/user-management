<?php


namespace Application\Controllers\Admin;


use Application\Admin\DashboardTransaction;
use Application\RendererInterface;

class DashboardController
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
        list($bg, $regbd, $regbd2, $query) = $this->transaction->dashboard();

        // Render a template
        echo $this->renderer->render('dashboard', compact('bg','regbd', 'regbd2', 'query'));
    }
}