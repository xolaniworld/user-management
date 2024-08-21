<?php
namespace Application;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Application\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Loader;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Routing\Loader\PhpFileLoader;


class Application
{
    public function run()
    {
        // looks inside *this* directory
        $fileLocator = new FileLocator([__DIR__]);
        $loader = new PhpFileLoader($fileLocator);
        $routes = $loader->load('RouteProvider.php');

//        $routes = new RouteCollection();
//        $routes->add('hello', new Route('/', [
//                '_controller' => function (Request $request) {
//                    return new Response(
//                        sprintf("Hello %s", $request->get('name'))
//                    );
//                }]
//        ));

        $request = Request::createFromGlobals();

        $matcher = new UrlMatcher($routes, new RequestContext());

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        $response = $kernel->handle($request);
        $response->send();

        $kernel->terminate($request, $response);
    }
}