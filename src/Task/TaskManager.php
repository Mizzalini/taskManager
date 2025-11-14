<?php
namespace App\Task;

class TaskManager {

    /**
     * Adds a new task
     * 
     * @param string $task The task description
     */
    public static function addTask(string $task): void {
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
    public static function markTaskAsCompleted(int $index): void {
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
    public static function deleteTaskByIndex(int $index): void {
        $tasks = $_SESSION['tasks'];

        if (isset($tasks[$index])) {
            unset($tasks[$index]);
            $_SESSION['tasks'] = $tasks;
        }
    }

    /**
     * Clears all tasks in the session
     */
    public static function clearAllTasks(): void {
        unset($_SESSION['tasks']);
    }
}