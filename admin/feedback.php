<?php
include __DIR__ . '/../bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $userGateway = new \Application\UsersGateway(get_database());
    $request = new \Application\Request();
    $filesystem = new \Application\Filesystem(IMAGES_DIR);
    $usersTransaction = new Application\Users\UsersTransactions($userGateway, $request, $filesystem);

    $msg = null;

    if (isset($_GET['del'])) {
        $usersTransaction->deleteUserById();
        $msg = "Data Deleted successfully";
    }

    if (isset($_REQUEST['unconfirm'])) {
        $usersTransaction->updateStatusUnConfirmed();

        $msg = "Changes Sucessfully";
    }

    if (isset($_REQUEST['confirm'])) {
        $usersTransaction->updateStatusConfirmed();

        $msg = "Changes Sucessfully";
    }

    $feedbackGateway = new \Application\FeedbackGateway(get_database());
    $feedbackTransaction = new \Application\FeedbackTransaction($feedbackGateway);
    $feedbackTransaction->findAdmin();
    $results = $feedbackTransaction->getFeedback();
    $count = $feedbackTransaction->getTotal();
    $cnt = 1;

    echo $templates->render('admin/feedback', compact('msg', 'results', 'count', 'cnt'));
}
