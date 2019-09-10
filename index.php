<?php
include __DIR__ . '/bootstrap.php';

if (isset($_POST['login'])) :
    $usersGateway = new \Application\UsersGateway(get_database());
    $loginTransaction = new \Application\LoginTransaction($usersGateway);
    $loginTransaction->submitLogin($_POST['username'], $_POST['password']);
    if ($loginTransaction->submitLogin($_POST['username'], $_POST['password'])) :
        $_SESSION['alogin'] = $_POST['username']; ?>
        <script type='text/javascript'> document.location = 'profile.php'; </script>
    <?php  else : ?>
        <script> alert('Invalid Details Or Account Not Confirmed');</script>
    <?php
    endif;
endif;

// Render a template
echo $templates->render('home');