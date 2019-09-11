<?php
include __DIR__ . '/bootstrap.php';

$factory = new \Application\ControllerFactory();
$factory->makeMainController()->home();