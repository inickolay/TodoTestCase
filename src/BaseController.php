<?php namespace Todo;

class BaseController
{
    private array $requestParams;

    private array $seo;

    public function __construct(private Route $route) {
        $this->requestParams = $this->route->parameters;
    }

    public function getRequestParams(): array
    {
        return $this->requestParams;
    }

    public function seo(string $title, string $description = '')
    {
        $this->seo['title'] = $title;
        if (!empty($description)) $this->seo['description'] = $description;
    }

    public function render(array $data = [])
    {
        $view = new View($data);

        if (!empty($this->seo)) {
            $view->setSeo($this->seo);
        }

        $view->render($this->route->controller, $this->route->action);
    }
}