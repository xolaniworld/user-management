<?php
include dirname(__DIR__) . '/bootstrap.php';
if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $adminGateway = new \Application\Admin\AdminGateway(get_database());
    $adminTransaction = new \Application\Admin\AdminTransaction($adminGateway);
    $msg = null;
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $adminTransaction->submitUpdateAdminUpdateUsernameAndPassword($name, $email);
        $msg = "Information Updated Successfully";
    }

    $result = $adminTransaction->getAll();
    $cnt = 1;

    echo $templates->render('admin/profile', compact('result', 'cnt', 'name', 'email', 'msg'));
}