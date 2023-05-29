<?php namespace Todo;

use App\Controllers\Error;

class View
{
    private string $viewsDirectory = '/app/Views';

    private string $title = '';

    private string $description = '';

    public function __construct(private array $data = []) {}

    public function setSeo(array $data)
    {
        $this->title = $data['title'];

        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
    }

    public function render(string $controller_name, string $action_name)
    {
        $viewPath = ROOT . $this->viewsDirectory .'/'. $controller_name .'/'. camelCaseToUnderscoreCase($action_name) . '.php';

        if (is_file($viewPath)) {
            extract($this->data);
            $title = $this->title;

            if (!empty($this->description)) {
                $description = $this->description;
            }

            ob_start();
            include_once($viewPath);
            $content = ob_get_clean();
            ob_end_clean();

            include_once ROOT . $this->viewsDirectory .'/layout.php';
        } else {
            throw new \Exception('View template `'. $controller_name .'/'. camelCaseToUnderscoreCase($action_name) .'` not found!');
        };
    }
}