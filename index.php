<?php

require __DIR__ . '/vendor/autoload.php';

$app = \TaskManager\System\App::instance();
echo $app->run();