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

    protected $middlewares = [
        \TaskManager\Middlewares\Authentication::class,
    ];

    /**
     * Executes the router to handle the current request
     * 
     * @return mixed The output from the router's run method
     */
    public function run(): mixed {
        $this->runMiddlewares();

        $router = Router::getInstance();
        return $router->run();
    }

    /**
     * Runs all registered middlewares
     * 
     * @return void
     */
    protected function runMiddlewares(): void {
        foreach ($this->middlewares as $middlewareClass) {
            $middleware = new $middlewareClass();
            $middleware->handle();
        }
    }
}