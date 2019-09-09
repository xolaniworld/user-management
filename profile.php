<?php

include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
header('location:index.php');
} else {
    $userGateway = new \Application\UsersGateway($dbh);
    $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new \Application\Filesystem(IMAGES_DIR));
    if(isset($_POST['submit'])) {
        $usersTransaction->submitEditFrontEnd();
	    $msg = "Information Updated Successfully";
    }

    $email = $_SESSION['alogin'];
    $result =$usersTransaction->findByEmail($email);
    $cnt=1;

    // Render a template
    echo $templates->render('profile', [
        'result' => $result,
        'email' => $email,
        'alogin' => $email,
        'cnt' => $cnt,
        'msg' => $msg,
    ]);
 }