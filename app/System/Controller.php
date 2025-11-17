<?php

namespace TaskManager\System;

/**
 * Abstract base controller for handling web requests
 * 
 * @package TaskManager
 * @subpackage System
 */
abstract class Controller {
    
    protected ?string $controllerName;
    private string $controllerViewPath = 'app/Views/';

    // Use Reflection to get the short name (e.g., "HomeController" becomes "home")
    public function __construct() {
        if (!isset($this->controllerName)) {
            $this->controllerName = \strtolower((new \ReflectionClass($this))->getShortName());
        }
    }

    /**
     * Renders the index view for the current controller.
     *
     * @param array $data Optional associative array of data to be passed to the view.
     *                     Default is an empty array.
     *
     * @return string|false The rendered view content as a string, or false if rendering fails.
     */
    public function index(array $data = []): string|false {
        $viewPath = $this->controllerViewPath . $this->controllerName . '/index.php';
        return $this->render($viewPath, $data);
    }

    protected function render(string $viewPath, array $data = []): string|false {
        try {
            return View::render($viewPath, $data);
        } catch (\Throwable $th) {
            return $this->renderError($th);
        }
    }

    protected function renderError(\Throwable $exception): string|false {
        $viewErrorPath = $this->controllerViewPath . 'error/index.php';
        $viewError = [
            'error' => $exception->getMessage(),
            'error_full' => $exception->getTraceAsString(),
        ];
        return View::render($viewErrorPath, $viewError);
    }
}