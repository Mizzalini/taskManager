<?php

namespace TaskManager\System;
use TaskManager\Traits\Singleton;

/**
 * Manages requests made by naviagation addresses
 * 
 * @package TaskManager
 * @subpackage System
 */
class Router {

    use Singleton;

    private array $routes = [];

    /**
     * Runs the method associated with the current path
     * 
     * @return string|false The output of the controller method or false on failure
     */
    public function run(): string|false {
        $path = $this->getCurrentPath();
        $controllerMapping = $this->routes[$path] ?? null;

        if ($controllerMapping) {
            [$controllerClass, $method] = $controllerMapping;
            $controller = new $controllerClass();
            return $controller->$method();
        }

        return View::render('layouts/page404.php');
    }

    /**
     * Gets the current request path
     * 
     * @return string The current request path
     */
    public function getCurrentPath(): string {
        return \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    private function init(): void {
        $this->routes = require \getcwd() . '/app/routes.php';
    }
}