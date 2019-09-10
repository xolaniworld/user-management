<?php

use Application\Request;

include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $msg = null;
    $error = null;
    // Code for change password
    if (isset($_POST['submit'])) {
        $usersGateway = new \Application\UsersGateway(get_database());
        $usersTransactions = new \Application\Users\UsersTransactions(
                $usersGateway,
                new Request(),
                new \Application\Filesystem(IMAGES_DIR)
        );

        if ($usersTransactions->changePassword($_SESSION['alogin'], $_POST['password'], $_POST['newpassword'])) {
            $msg = "Your Password succesfully changed";
        } else {
            $error = "Your current password is not valid.";
        }
    }

    $alogin = $_SESSION['alogin'];
    // Render a template
    echo $templates->render('change_password', compact('alogin','msg', 'error'));
}