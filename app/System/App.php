<?php

namespace TaskManager\System;
use TaskManager\Traits\Singleton;

/**
 * Handles user navigation requests, executing the appropriate controller
 * 
 * @package TaskManager
 * @subpackage System
 */
class App {
    use Singleton;

    /**
     * Executes the router to handle the current request
     * 
     * @return mixed The output from the router's run method
     */
    public function run(): mixed {
        $router = Router::getInstance();
        return $router->run();
    }
}