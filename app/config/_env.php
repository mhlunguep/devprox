<?php

//define the base path
define('BASE_PATH',  realpath(__DIR__.'/../../'));

require_once __DIR__.'/../../vendor/autoload.php'; 

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);
$dotenv->Load();