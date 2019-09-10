<?php
include __DIR__ . '/../bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $editid = null;
    $msg = null;

    if(isset($_GET['edit'])) {
        $editid = $_GET['edit'];
    }

    $usersGateway = new \Application\UsersGateway(get_database());
    $request = new \Application\Request();
    $filesystem = new \Application\Filesystem(IMAGES_DIR);
    $usersTransactions = new \Application\Users\UsersTransactions($usersGateway, $request, $filesystem);

    if(isset($_POST['submit'])) {
        $usersTransactions->submitEdit();
        $msg = "Information Updated Successfully";
    }

    $result = $usersTransactions->findByUserId($_GET['edit']);

    // Render a template
    echo $templates->render('edit-user', compact('result','editid', 'cnt'));
}