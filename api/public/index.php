<?php

// load composer dependencies
require '../vendor/autoload.php';


// Load our helpers
require_once '../app/helpers.php';

// Load our custom routes
require_once '../routes/api.php';

use Pecee\SimpleRouter\SimpleRouter;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

SimpleRouter::enableMultiRouteRendering(false);

// Start the routing
echo SimpleRouter::start();