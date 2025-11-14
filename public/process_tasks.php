<?php

require_once __DIR__ . '/../bootstrap.php';

use App\Task\TaskManager;

if (isset($_POST['task']) && !empty($_POST['task'])) {
    TaskManager::addTask(task: $_POST['task']);
}

if (isset($_POST['clear'])) {
    TaskManager::clearAllTasks();
}

if (isset($_POST['completed']) && isset($_POST['index'])) {
    TaskManager::markTaskAsCompleted(index: (int)$_POST['index']);
}

if (isset($_POST['delete']) && isset($_POST['index'])) {
    TaskManager::deleteTaskByIndex(index: (int)$_POST['index']);
}

header("Location: index.php");
exit;