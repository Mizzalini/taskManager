<?php

namespace TaskManager\Models;

class Task {

    public function __get(string $property) {
        if ($property === 'tasks') {
            return $_SESSION[$property] ?? [];
        }
        throw new \Exception("Property {$property} does not exist.");
    }

    /**
     * Create a new task and store it in the session.
     *
     * @param array $data The data of the task to be created.
     * @return void
     */
    public function createTask(array $data): void {
        $tasks = $this->tasks;
        $tasks[] = $data;
        $_SESSION['tasks'] = $tasks;
    }

    /**
     * Marks a task as completed.
     * 
     * @param int $index The index of the task to be marked as completed.
     * @return void
     */
    public function markTaskAsCompleted(int $index): void {
        $tasks = $this->tasks;

        if (isset($tasks[$index])) {
            $tasks[$index]['completed'] = true;
            $_SESSION['tasks'] = $tasks;
        }
    }

    /**
     * Deletes a task.
     * 
     * @param int $index The index of the task to be deleted.
     * @return void
     */
    public function deleteTaskByIndex(int $index): void {
        $tasks = $_SESSION['tasks'];

        if (isset($tasks[$index])) {
            unset($tasks[$index]);
            $_SESSION['tasks'] = $tasks;
        }
    }

    /**
     * Clears all tasks.
     * 
     * @return void
     */
    public function clearAllTasks(): void {
        unset($_SESSION['tasks']);
    }
}