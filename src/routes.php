<?php

use App\Controller\AdminController;
use App\Controller\MainController;
use App\Controller\UsersController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller\FeedbackController;

$controllerFactory = new \App\Controller\ControllerFactory();

return function (RoutingConfigurator $routes) use ($controllerFactory) {

    $routes->add('home', '/')
        ->controller([MainController::class, 'home'])
        ->methods(['GET']);

    $routes->add('home_login', '/')
        ->controller([MainController::class, 'login'])
        ->methods(['POST']);

    $routes->add('profile', '/profile')
        ->controller([UsersController::class, 'profile'])
        ->methods(['GET']);

    $routes->add('feedback', '/feedback')
        ->controller([FeedbackController::class, 'frontend']);

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
        ->controller([FeedbackController::class, 'messages']);

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
        ->controller([AdminController::class, 'index'])
        ->methods(['GET']);

    $routes->add('admin_login', '/admin/login')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                return new Response(
                    $controllerFactory->makeAdminController()->login()
                );
            }
        )->methods(['POST'])
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
                $deletedUserGateway = new \App\Gateway\DeletedUserGateway(get_database());
                $transaction = new \App\Transaction\DeletedUsersTransaction($deletedUserGateway);
                $controller = new \App\Controller\DeletedUsersController(
                    $transaction,
                    new \App\PlatesTemplate(__DIR__ . '/../templates')
                );

                return new Response(
                    $controller->all()
                );
            }
        )
    ;

    $routes->add('admin-download', '/admin/download')
        ->controller(
            function (Request $request) use ($controllerFactory) {
                $usersGateway = new \App\Gateway\UsersGateway(get_database());
                $transaction = new \App\Transaction\DownloadTransaction($usersGateway);
                $controller = new \App\Controller\DownloadController($transaction);

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
                \App\Session::destroy();
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
                \App\Session::destroy();
                header("location: /");
                exit;
            }
        )
    ;
};