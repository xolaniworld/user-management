<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', 'dbuser');
define('DB_NAME', '2520448_armentum');

define('ROOT_DIR', dirname(__DIR__));
define('IMAGES_DIR', ROOT_DIR . '/images/');
define('INCLUDES_DIR', ROOT_DIR . '/includes/');
define('ATTACHMENT_DIR', ROOT_DIR . '/attachment/');
define('TEMPLATES_DIR', ROOT_DIR . '/templates/');

include INCLUDES_DIR . 'functions.php';

$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Create new Plates instance
$templates = new League\Plates\Engine(TEMPLATES_DIR);