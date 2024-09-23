<?php


namespace Tests\Unit\Contollers;

use Application\Controllers\FeedbackController;
use Application\RendererInterface;
use Application\Transactions\FrontendFeedbackTransaction;
use Prophecy;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FeedbackControllerTest extends \PHPUnit\Framework\TestCase
{
    private $controller;
    private $prophet;
    private $transaction;
    private $renderer;
    private $request;
    private $session;

    public function setUp(): void
    {
        $this->prophet = new Prophecy\Prophet();

        $this->transaction = $this->prophet->prophesize(FrontendFeedbackTransaction::class);
        $this->renderer = $this->prophet->prophesize(RendererInterface::class);
        $this->request = $this->prophet->prophesize(ServerRequestInterface::class);
        $this->session = $this->prophet->prophesize(Session::class);
        $this->controller = new FeedbackController(
            $this->transaction->reveal(),
            $this->renderer->reveal(),
            $this->request->reveal(),
            $this->session->reveal()
        );
    }

    public function test_frontend()
    {
        $this->controller->frontend();
    }

    public function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}