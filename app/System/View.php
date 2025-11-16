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
     * 
     * 
     * @param string $viewFile
     * @param array $variables
     * @return string|false
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