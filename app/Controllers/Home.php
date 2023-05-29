<?php namespace App\Controllers;

use App\Models\Task;
use Todo\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $this->seo('Main page');

        $task = new Task();

        $data = $this->getRequestParams();
        $page = $data['page'] ?? 1;
        $perPage = 3;
        $sortField = $data['sort'] ?? 'id';
        $sortOrder = $data['order'] ?? 'DESC';

        $this->render([
            'tasks' => $task->paginate( $page, $perPage, $sortField, $sortOrder),
            'page' => (int) $page,
            'perPage' => $perPage,
            'total' => $task->count(),
        ]);
    }
}