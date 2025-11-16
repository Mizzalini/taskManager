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
        if (!$this->controllerName) {
            $this->$controllerName = \strtolower((new \ReflectionClass($this))->getShortName());
        }
    }

    /**
     * Renders the default "index" view for this controller
     * 
     * @param array $data Associative array of variables to pass to the view
     * @return string|false The rendered HTML as a string, or false on failure
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

    protected function renderError(Throwable $exception): string|false {
        $viewErrorPath = $this->controllerViewPath . 'error/index.php';
        $viewError = [
            'error' => $exception->getMessage(),
            'error_full' => $exception->getTraceAsString(),
        ];
        return View::render($viewErrorPath, $viewError);
    }
}