<?php
include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
    exit;
} else {
    $factory = new \Application\ControllerFactory();
    $factory->makeFeedbackController()->frontend();
}