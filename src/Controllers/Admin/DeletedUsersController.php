<?php


namespace Application\Controllers\Admin;

use Application\DeletedUsersTransaction;
use Application\RendererInterface;

class DeletedUsersController
{
    private $transaction;
    private $renderer;

    public function __construct(DeletedUsersTransaction $transaction, RendererInterface $renderer)
    {
        $this->transaction = $transaction;
        $this->renderer = $renderer;
    }

    public function all()
    {
        list($results, $count) = $this->transaction->findAllDeletedUsers();
        $cnt = 1;

        // Render a template
        echo $this->renderer->render('deleteduser', compact('results', 'count', 'cnt'));
    }
}