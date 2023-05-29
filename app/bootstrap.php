<?php

if (DEBUG) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

require_once ROOT .'/app/helpers.php';

$router = new \Todo\Route();

$core = new \Todo\Core($router->dispatch());
