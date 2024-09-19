<?php


namespace App\Controller;


use App\PlatesTemplate;
use App\RendererInterface;
use Symfony\Component\HttpFoundation\Response;

class AbstractController
{
    /**
     * @var RendererInterface
     */
    private RendererInterface $renderer;

    public function authenticated()
    {
        if (\App\Authentication::isNotLoggedIn()) {
            header('location: /');
            exit;
        }
    }

    /**
     * @param string $view
     * @param array $params
     * @return Response
     */
    public function render(string $view, array $params = []) : Response
    {
        $renderer = new PlatesTemplate(__DIR__ . '/../../templates');
        return new Response($renderer->render($view, $params));
    }
}