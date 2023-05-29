<?php namespace Todo;

class Route
{
    public string $controller = 'home';

    public string $action = 'index';

    public string $method;

    public array $parameters = [];

    public array $postParameters = [];

    public array $getParameters = [];

    public function dispatch(): Route
    {
        $rawUrl = $_SERVER['REQUEST_URI'];

        if ('/' !== $rawUrl) $rawUrl = ltrim($rawUrl, '/');

        $rawUrl = str_replace(['"', "'", '\\'], '', $rawUrl);

        $separatorPosition = strpos($rawUrl, '?');

        $rawRoute = $separatorPosition !== false ? substr($rawUrl, 0, $separatorPosition) : $rawUrl;
        $rawParams = $separatorPosition !== false ? substr($rawUrl, $separatorPosition + 1) : null;

        if (!empty($rawRoute) && '/' !== $rawRoute) {
            $routeData = explode('/', $rawRoute);

            $this->controller = strtolower(array_shift($routeData));
            $action = strtolower(array_shift($routeData));

            if (!empty($action)) {
                $this->action = $action;
            }
        }


        $this->method = strtolower($_SERVER['REQUEST_METHOD'] ?? 'undefined');

        if (isset($_POST['_method'])) {
            $postMethod = strtolower($_POST['_method']);
            $this->method = in_array($postMethod, ['put', 'patch', 'delete']) ? $postMethod : 'post';
        }

        if (!empty($_POST)) {
            $this->postParameters = $_POST;
        } else if (!empty(file_get_contents('php://input'))) {
            $this->postParameters = json_decode(trim(file_get_contents('php://input')), true);
        }
        $this->parameters = array_merge($this->parameters, $this->postParameters);

        if (!empty($rawParams)) {
            foreach (explode('&', $rawParams) as $param) {
                if (str_contains($param, '=')) {
                    [$key, $val] = explode('=', $param);
                    $this->getParameters[$key] = $val;
                } else {
                    $this->getParameters[$param] = true;
                }
            }
        }
        
        $this->parameters = array_merge($this->parameters, $this->getParameters);

        return $this;
    }
}