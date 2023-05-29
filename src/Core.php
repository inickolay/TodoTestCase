<?php namespace Todo;

use App\Controllers\Error;

class Core
{
    private string $controllersDirectory = '/app/Controllers';
    private string $controllersNamespace = 'App\Controllers';

    public function __construct(Route $route)
    {
        $controllerFileName =  ucfirst($route->controller);
        $controllerPath = ROOT . $this->controllersDirectory .'/'. $controllerFileName .'.php';
        $class = $this->controllersNamespace .'\\'. $controllerFileName;

        if (is_file($controllerPath) && method_exists($class, $route->action)) {
            $controller = new $class($route);
            $action = $route->action;
        } else {
            $route->controller = 'error';
            $route->action = 'pageNotFound';

            $controller = new Error($route);
            $action = 'pageNotFound';
        }

        $controller->$action();
    }
}