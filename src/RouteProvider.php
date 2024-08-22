<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

$controllerFactory = new \Application\Controllers\ControllerFactory();

return function (RoutingConfigurator $routes) use ($controllerFactory) {
//    $routes->add('home', '/')
//        ->controller(\Application\Controllers\MainController::class)
//        // ...
//    ;
//        $routes->add('hello', new Route('/', [
//                '_controller' => function (Request $request) {
//                    return new Response(
//                        sprintf("Hello %s", $request->get('name'))
//                    );
//                }]
//        ));

        $routes->add('home', '/')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeMainController()->home()
                );
            }
        )
        ;

    $routes->add('profile', '/profile')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeUserController()->profile()
                );
            }
        )
    ;

    $routes->add('feedback', '/feedback')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeFeedbackController()->frontend()
                );
            }
        )
    ;

    $routes->add('notification', '/notification')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeNotificationController()->notification()
                );
            }
        )
    ;

    $routes->add('messages', '/messages')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeFeedbackController()->messages()
                );
            }
        )
    ;

    $routes->add('change-password', '/change-password')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeUserController()->changePassword()
                );
            }
        )
    ;

    $routes->add('register', '/register')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeRegisterController()->register()
                );
            }
        )
    ;

    $routes->add('admin', '/admin')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminController()->login()
                );
            }
        )
    ;

    $routes->add('admin-dashboard', '/admin/dashboard')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeDashboardController()->dashboard()
                );
            }
        )
    ;


    $routes->add('admin-userlist', '/admin/userlist')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeUserListController()->all()
                );
            }
        )
    ;

    $routes->add('admin-profile', '/admin/profile')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminController()->profile()
                );
            }
        )
    ;

    $routes->add('admin-feedback', '/admin/feedback')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminFeedbackController()->feedback()
                );
            }
        )
    ;

    $routes->add('admin-notification', '/admin/notification')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminNotificationController()->notification()
                );
            }
        )
    ;

    $routes->add('admin-deleteduser', '/admin/deleteduser')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                $deletedUserGateway = new \Application\Gateways\DeletedUserGateway(get_database());
                $transaction = new \Application\Transactions\DeletedUsersTransaction($deletedUserGateway);
                $controller = new \Application\Controllers\DeletedUsersController($transaction, new \Application\PlatesTemplate(TEMPLATES_DIR));

                return new Response(
                    $controller->all()
                );
            }
        )
    ;

    $routes->add('admin-download', '/admin/download')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                $usersGateway = new \Application\Gateways\UsersGateway(get_database());
                $transaction = new \Application\Transactions\DownloadTransaction($usersGateway);
                $controller = new \Application\Controllers\DownloadController($transaction);

                $controller->download();
                exit;
            }
        )
    ;

    $routes->add('admin-change-password', '/admin/change-password')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminController()->changePassword()
                );
            }
        )
    ;

    $routes->add('admin-logout', '/admin/logout')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 60*60,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
                \Application\Session::destroy();
                header("location: /admin");
                exit;
            }
        )
    ;

    $routes->add('logout', '/logout')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 60*60,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
                \Application\Session::destroy();
                header("location: /");
                exit;
            }
        )
    ;

};