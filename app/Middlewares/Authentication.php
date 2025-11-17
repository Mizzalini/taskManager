<?php

namespace TaskManager\Middlewares;

use TaskManager\System\Redirect;
use TaskManager\System\Router;

class Authentication {

    private $unauthenticatedRoutes = [
        '/login',
        '/login/submit'
    ];

    /**
     * Handles authentication for incoming requests
     */
    public function handle() {
        $router = Router::getInstance();
        if (in_array($router->getCurrentPath(), $this->unauthenticatedRoutes)) {
            return;
        }

        if (!isset($_SESSION['userLogged'])) {
            return Redirect::to('/login');
        }
    }
}