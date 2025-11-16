<?php

namespace TaskManager\System;

/**
 * Manages redirects made via PHP
 * 
 * @package TaskManager
 * @subpackage System
 */
class Redirect {
    
    /**
     * Performs a HTTP redirect to a specified URL
     * 
     * @param string $url The base URL to redirect to
     * @param array $params The array of key/value pairs to build as a URL query string
     */
    public static function to(string $url, array $params = []): void {
        if (!empty($params)) {
            $queryString = \http_build_query($params);
            $url .= '?' . $queryString;
        }

        \header('Location: ' . $url);
        exit;
    }
}