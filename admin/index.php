<?php
include dirname(__DIR__) . '/bootstrap.php';
$request = new \Application\Request();
$session = new \Application\Session();

$factory = new \Application\ControllerFactory();
$factory->makeAdminController()->login();
