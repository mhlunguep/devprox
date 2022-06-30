<?php

$router = new AltoRouter;

// for test 1 route
 $router->map('GET', '/', 'App\Controllers\Test1Controller@show', 'user_form');
 $router->map('POST', '/', 'App\Controllers\Test1Controller@store', 'create_user_form');

 // for test 2 route
 $router->map('GET', '/test2', 'App\Controllers\Test2Controller@show', 'csv_form');
 $router->map('POST', '/test2', 'App\Controllers\Test2Controller@generate_csv', 'download_csv_form');
 
 $router->map('POST', '/test2/import_csv', 'App\Controllers\Test2Controller@import_csv', 'import_csv_file');
