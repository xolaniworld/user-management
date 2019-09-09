<?php

include __DIR__ . '/bootstrap.php';

$error = null;

if (isset($_POST['submit'])) {
    $notificationGateway = new \Application\NotificationGateway($dbh);
    $usersGateway = new \Application\UsersGateway($dbh);
    $registerTransaction = new \Application\RegisterTransaction($usersGateway, $notificationGateway, new \Application\Filesystem(IMAGES_DIR));
    $success = $registerTransaction->submitRegister(new \Application\Request());

    if ($success) { ?>
        <script type='text/javascript'>alert('Registration Sucessfull!');</script>
        <script type='text/javascript'> document.location = 'index.php'; </script>
    <?php } else {
        $error = "Something went wrong. Please try again";
    }
}

// Render a template
echo $templates->render('register', [
    'error' => $error
]);