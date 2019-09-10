<?php
include __DIR__ . '/../bootstrap.php';

$session = new \Application\Session();
$request = new \Application\Request();

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $adminGateway = new \Application\Admin\AdminGateway(get_database());
    $adminTransaction = new \Application\Admin\AdminTransaction($adminGateway);

    if ($request->postIsset('submit')) {
        $adminTransaction->submitUpdateAdminUpdateUsernameAndPassword(
            $request->getPost('name'),
            $request->getPost('email')
        );
        $msg = "Information Updated Successfully";
    }
    $notificationGateway = new \Application\NotificationGateway(get_database());
    $notificationTransaction = new \Application\NotificationTransaction($notificationGateway);
    $notificationTransaction->findAdminNotifications();
    $results = $notificationTransaction->getNotications();
    $count = $notificationTransaction->getTotal();
    $cnt = 1;

    echo $templates->render('admin/notification', compact('results', 'count', 'cnt'));
}