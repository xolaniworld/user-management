<?php
include dirname(__DIR__) . '/bootstrap.php';
$request = new \Application\Request();
$session = new \Application\Session();


if ($request->getRequestMethod() === 'POST') :
    $username = $request->getPost('username');
    $password = $request->getPost('password');
    $transaction = new \Application\Admin\AdminTransaction(new \Application\Admin\AdminGateway(get_database()));
    if ($transaction->submitLogin($username, $password)):
        $session->set('alogin', $username); ?>
        <script type='text/javascript'> document.location = 'dashboard.php'; </script>
    <?php else : ?>
        <script> alert('Invalid Details');</script>
    <?php endif;
endif;
// Render a template
echo $templates->render('admin/index');
