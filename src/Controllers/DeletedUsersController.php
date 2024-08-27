<?php


namespace App\Controllers;

use App\RendererInterface;
use App\Transactions\DeletedUsersTransaction;

class DeletedUsersController extends AbstractController
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
        $this->authenticated();

        list($results, $count) = $this->transaction->findAllDeletedUsers();
        $cnt = 1;

        // Render a template
        return $this->renderer->render('deleteduser', compact('results', 'count', 'cnt'));
    }
}