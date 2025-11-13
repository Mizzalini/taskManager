<?php
include_once 'config_global.php';

/**
 * Adds a new task
 * 
 * @param string $task The task description
 */
function addTask(string $task): void {
    $tasks = $_SESSION['tasks'] ?? array();

    $tasks[] = [
        'task' => ucfirst($task),
        'completed' => false,
    ];
    $_SESSION['tasks'] = $tasks;
}

/**
 * Marks a task as completed
 * 
 * @param int $index The index of the task to complete
 */
function markTaskAsCompleted(int $index): void {
    $tasks = $_SESSION['tasks'];

    if (isset($tasks[$index])) {
        $tasks[$index]['completed'] = true;
        $_SESSION['tasks'] = $tasks;
    }
}

/**
 * Removes a specific task based on provided index
 * 
 * @param int $index The index of the task to remove
 */
function deleteTaskByIndex(int $index): void {
    $tasks = $_SESSION['tasks'];

    if (isset($tasks[$index])) {
        unset($tasks[$index]);
        $_SESSION['tasks'] = $tasks;
    }
}

/**
 * Clears all tasks in the session
 */
function clearAllTasks(): void {
    unset($_SESSION['tasks']);
}