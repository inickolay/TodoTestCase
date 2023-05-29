<?php namespace App\Controllers;

use Todo\BaseController;
use Todo\Session;

class Auth extends BaseController
{
    public function login()
    {
        if (Session::isAuth()) {
            header('Location: /', 301);
            exit;
        }

        $this->seo('Log in');

        $this->render();
    }

    public function index()
    {
        $loginData = $this->getRequestParams();

        if ($_ENV['ADMIN_LOGIN'] === $loginData['login'] && $_ENV['ADMIN_PASSWORD'] === $loginData['password']) {
            Session::login();
            Session::createMessage('success', 'You are now logged in!');
            header('Location: /', 301);
            exit;
        }

        Session::createMessage('error', 'Wrong credentials!');
        header('Location: /auth/login', 301);
        exit;
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        Session::createMessage('success', 'You are now logged out!');
        header('Location: /', 301);
        exit;
    }
}