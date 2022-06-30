<?php
// start session if it is not already started
if (!isset($_SESSION)) {
    session_start();
}

//loading enveroment variables in my app
require_once __DIR__ . '/../app/config/_env.php';

// instintiate datadase class
new App\Classes\Database();

//register routes on our project
require_once __DIR__ . '/../app/routing/routes.php';
new App\Routing\RouteDispatcher($router);
