<?php

include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $userGateway = new \Application\UsersGateway(get_database());
    $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new \Application\Filesystem(IMAGES_DIR));
    $msg = null;
    if (isset($_POST['submit'])) {
        $usersTransaction->submitEditFrontEnd();
        $msg = "Information Updated Successfully";
    }

    $email = $_SESSION['alogin'];
    $result = $usersTransaction->findByEmail($email);
    $cnt = 1;

    // Render a template
    echo $templates->render('profile', compact('result','email', 'alogin', 'cnt', 'msg'));
}