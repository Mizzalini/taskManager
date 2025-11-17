<?php

namespace TaskManager\Controllers;

use TaskManager\Models\Task;
use TaskManager\System\Controller;
use TaskManager\System\Redirect;

class Tasks extends Controller {

    public Task $taskModel;

    public function __construct() {
        parent::__construct();
        $this->taskModel = new Task;
    }

    /**
     * Display the list of tasks.
     *
     * @param array|null $data Additional data to pass to the view.
     * @param string|null $layout The layout to use for rendering.
     * @return string|false The rendered view or false on failure.
     */
    public function index(array $data = [], string $layout = null): string|false {
        return parent::index([
            'tasks' => $this->taskModel->tasks
        ]);
    }

    /**
     * Creates a new task
     *
     * @return void
     */
    public function onCreateTask(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $payload = [
                'task' => ucfirst($_POST['task']),
                'completed' => false,
            ];
            $this->taskModel->createTask($payload);

            Redirect::to('/tasks', [
                'success' => 'Task created successfully.'
            ]);
        } catch (\Throwable $th) {
            Redirect::to('/tasks', [
                'error' => 'Failed to create task: ' . $th->getMessage()
            ]);
        }
    }
    
    /**
     * Manages actions that involve marking a task as completed or deleting it
     *
     * @return void
     */
    public function onActionTask(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            if (!method_exists($this->taskModel, $_POST['action'])) {
                throw new \Exception('Method does not exist');
            }

            $this->taskModel->{$_POST['action']}((int) $_POST['index']);

            Redirect::to('/tasks', [
                'success' => 'Task updated successfully.'
            ]);
        } catch (\Throwable $th) {
            Redirect::to('/tasks', [
                'error' => 'Failed to update task: ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Clears all tasks
     * 
     * @return void
     */
    public function onDeleteAll(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $this->taskModel->clearAllTasks();

            Redirect::to('/tasks', [
                'success' => 'All tasks cleared successfully.'
            ]);
        } catch (\Throwable $th) {
            Redirect::to('/tasks', [
                'error' => 'Failed to clear tasks: ' . $th->getMessage()
            ]);
        }
    }
}