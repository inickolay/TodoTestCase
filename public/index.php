<?php
/**
* Define important constants.
*/
define('DEBUG', true);
define('ROOT', dirname(__DIR__));
define('TIME_START', microtime(true));

/**
* Composer autoload
*/
require_once ROOT . '/vendor/autoload.php';

/**
 * Bootstrap application
 */
require_once ROOT . '/app/bootstrap.php';
