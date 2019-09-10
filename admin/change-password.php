<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $msg = null;
    $error = null;
    if(isset($_POST['submit'])) {
        $adminTransactions = new \Application\Admin\AdminTransaction(new \Application\Admin\AdminGateway(get_database()));
        if ($adminTransactions->submitChangePassword($_SESSION['alogin'], $_POST['password'], $_POST['newpassword'])) {
            $msg = "Your Password succesfully changed";
        } else {
            $error =  "Your current password is not valid.";
        }
    }

    echo $templates->render('admin/change-password', compact('msg', 'error'));
}