<?php

namespace TaskManager\System;

/**
 * Renders view/template files
 * 
 * @package TaskManager
 * @subpackage System
 */
class View {

    /**
     * Renders a view file and returns its output as a string
     * 
     * @param string $viewFile The path to the view/template file
     * @param array $variables An associative array of variables to make available to the view file
     * @return string|false The rendered content as a string, or 'false' on failure
     */
    public static function render(string $viewFile, array $variables = []): string|false {
        \ob_start();
        \extract($variables);

        try {
            $filePath = \getcwd() . '/' . $viewFile;
            if (!\file_exists($filePath)) {
                throw new Exception("FilePath: {$filePath} does not exist");
            }

            include $filePath;
        } catch (\Throwable $e) {
            throw $e;
        }

        return \ob_get_clean();
    }
}