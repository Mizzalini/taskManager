<?php

namespace TaskManager\Controllers;
use TaskManager\System\Controller;

class Home extends Controller {

    /**
     * Renders the home page with a list of tasks
     * 
     * @param array $data Additional data to pass to the view
     * @return string|false The rendered home page content or 'false' on failure
     */
    public function index(array $data = []): string|false {
        $tasks = $_SESSION['tasks'] ?? [];
        return parent::index(['tasks' => $tasks]);
    }
}