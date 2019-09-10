<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $userListTransaction = new \Application\UserListTransaction(
        new \Application\UsersGateway(get_database()),
        new \Application\DeletedUserGateway(get_database())
    );

    if (isset($_GET['del']) && isset($_GET['name'])) {
        $id = $_GET['del'];
        $name = $_GET['name'];
        $userListTransaction->deleteUserAndUpdateDeletedUsers($id, $name);
        $msg = "Data Deleted successfully";
    }

    if (isset($_REQUEST['unconfirm'])) {
        $userListTransaction->userConfirmed($_GET['unconfirm']);
        $msg = "Changes Sucessfully";
    }

    if (isset($_REQUEST['confirm'])) {
        $userListTransaction->userUnconfirmed($_GET['confirm']);
        $msg = "Changes Sucessfully";
    }

    list($results, $rowCount) = $userListTransaction->findAllUsers();

    echo $templates->render('admin/userlist', compact('results', 'rowCount', 'msg'));
}
