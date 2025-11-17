<?php

use TaskManager\Controllers\Home;
use TaskManager\Controllers\Login;

return [
    '/' => [Home::class, 'index'],
    '/login' => [Login::class, 'index'],
    '/login/submit' => [Login::class, 'onLogin'],
];