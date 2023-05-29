<?php namespace App\Controllers;

use Todo\BaseController;
use App\Models\Task as TaskModel;
use Todo\Session;

class Task extends BaseController
{
    public function create()
    {
        $taskData = $this->getRequestParams();
        $task = new TaskModel();
        $newTask = $task->create($taskData['name'], $taskData['email'], $taskData['text']);
        Session::createMessage('success', 'New task was added!');
        header('Location: /', 301);
        exit;
    }

    public function update()
    {
        if (Session::isAuth()) {
            $taskData = $this->getRequestParams();
            Session::createMessage('success', 'Task were updated!');
            $task = new TaskModel();
            $status = isset($taskData['is_done']) && 'on' === $taskData['is_done'] ? 1 : 0;
            $task->update($taskData['id'], $taskData['name'], $taskData['email'], $taskData['text'], $status);
        }

        Session::createMessage('error', 'Not enough rights!');

        header('Location: ' . $_SERVER['HTTP_REFERER'], 301);
        exit;
    }
}