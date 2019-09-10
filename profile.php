<?php

include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    /* DEPENDENCY */
    $userGateway = new \Application\UsersGateway(get_database());
    $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new \Application\Filesystem(IMAGES_DIR));

    /* CONTROLLER */
    $msg = null;
    if (isset($_POST['submit'])) {
        $usersTransaction->submitEditFrontEnd();
        $msg = "Information Updated Successfully";
    }

    $alogin = $_SESSION['alogin'];
    $result = $usersTransaction->findByEmail($alogin);
    $cnt = 1;

    /* FINISHED */
    echo $templates->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
}