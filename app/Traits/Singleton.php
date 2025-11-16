<?php

namespace TaskManager\Traits;

trait Singleton {
    private static $instance = null;

    final protected function __construct() {
        $this->init();
    }

    /**
     * Returns the client existing object
     * 
     * @return mixed the client existing object
     */
    final public static function getInstance(): mixed {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Initialises the singleton
     */
    protected function init(): void {

    }
}