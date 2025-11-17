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
     * @param string $layout The path to the layout file. Default is 'layouts/index.php'.
     *
     * @return string|false The rendered view content as a string, or false if rendering fails.
     */
    public function index(array $data = [], string $layout = 'layouts/index.php'): string|false {
        $viewPath = $this->controllerViewPath . $this->controllerName . '/index.php';
        return $this->renderWithLayout($viewPath, $data, $layout);
    }

    /**
     * Renders a view file with the given data.
     *
     * @param string $viewPath The path to the view file.
     * @param array $data Optional associative array of data to be passed to the view.
     *                     Default is an empty array.
     *
     * @return string|false The rendered view content as a string, or false if rendering fails.
     */
    protected function render(string $viewPath, array $data = []): string|false {
        try {
            return View::render($viewPath, $data);
        } catch (\Throwable $th) {
            return $this->renderError($th);
        }
    }

    /**
     * Renders a view file within a layout with the given data.
     *
     * @param string $viewPath The path to the view file.
     * @param array $data Optional associative array of data to be passed to the view.
     *                     Default is an empty array.
     * @param string $layout The path to the layout file. Default is 'layouts/index.php'.
     *
     * @return string|false The rendered view content as a string, or false if rendering fails.
     */
    protected function renderWithLayout(string $viewPath, array $data = [], string $layout = 'layouts/index.php'): string|false {
        try {
            return View::renderWithLayout($viewPath, $data, $layout);
        } catch (\Throwable $th) {
            return $this->renderError($th);
        }
    }

    /**
     * Renders an error view with the given exception details.
     *
     * @param \Throwable $exception The exception to be displayed in the error view.
     * @param string|null $layout Optional layout file path. If provided, the error view will be rendered within this layout.
     *
     * @return string|false The rendered error view content as a string, or false if rendering fails.
     */
    protected function renderError(\Throwable $exception, string $layout = null): string|false {
        $viewErrorPath = $this->controllerViewPath . 'error/index.php';
        $viewError = [
            'error' => $exception->getMessage(),
            'error_full' => $exception->getTraceAsString(),
        ];

        if ($layout) {
            return View::renderWithLayout($viewErrorPath, $viewError, $layout);
        }

        return View::render($viewErrorPath, $viewError);
    }
}