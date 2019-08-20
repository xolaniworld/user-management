<?php
include __DIR__ . '/../bootstrap.php';

$authTransaction = new \Application\AuthTransaction(
    new \Application\Session(),
    new \Application\Request(),
    ini_get("session.use_cookies")
);
$authTransaction->logout();
header("location:index.php");

