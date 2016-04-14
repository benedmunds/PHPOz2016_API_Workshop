<?php

ini_set('display_errors', 1);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('America/Chicago');

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);


//WORKSHOP - Instantiate SQlite PDO
$db = new PDO('sqlite:../workshopDb.sqlite3');


// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';
require __DIR__ . '/../src/routes/status.php';
require __DIR__ . '/../src/routes/user.php';


// Register models
require __DIR__ . '/../src/models/status.php';
require __DIR__ . '/../src/models/user.php';

// Run app
$app->run();
