<?php
// DB credentials.
require __DIR__ . '/db.php';

define('ROOT_DIR', dirname(__DIR__));
define('INCLUDES_DIR', ROOT_DIR . '/includes/');
define('STORAGE_DIR', ROOT_DIR . '/storage/');
define('PUBLIC_DIR', ROOT_DIR . '/public/');
define('IMAGES_DIR', PUBLIC_DIR . '/images/');
define('ATTACHMENT_DIR', PUBLIC_DIR . '/attachment/');
define('TEMPLATES_DIR', ROOT_DIR . '/templates/');

include INCLUDES_DIR . 'functions.php';

$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Create new Plates instance
$templates = new League\Plates\Engine(TEMPLATES_DIR);