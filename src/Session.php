<?php namespace Todo;

use App\Controllers\Error;

class Session
{
    static public function createMessage($name, $text)
    {
        $_SESSION[$name] = $text;
    }

    static public function getMessage($name)
    {
        if (!isset($_SESSION[$name])) return null;

        $message = $_SESSION[$name];

        unset($_SESSION[$name]);

        return $message;
    }

    static public function login()
    {
        $_SESSION['auth'] = $_ENV['ADMIN_PASSWORD'] . $_ENV['ADMIN_HASH'];
    }

    static public function isAuth()
    {
        return isset($_SESSION['auth']) && $_ENV['ADMIN_PASSWORD'] . $_ENV['ADMIN_HASH'] === $_SESSION['auth'];
    }
}