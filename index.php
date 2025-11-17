<?php

\session_start();

require __DIR__ . '/vendor/autoload.php';

$app = \TaskManager\System\App::getInstance();
echo $app->run();