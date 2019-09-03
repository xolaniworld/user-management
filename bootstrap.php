<?php
session_start();

error_reporting(E_ALL);

include __DIR__ . '/composer_vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

include __DIR__ . '/includes/config.php';
