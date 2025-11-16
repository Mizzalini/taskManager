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

    private function init(): void {
        $this->routes = require \getcwd() . '/app/routes.php';
    }
}