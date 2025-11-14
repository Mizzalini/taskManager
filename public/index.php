<?php

require_once __DIR__ . '/../bootstrap.php';

if (!isset($_SESSION['userLogged'])) {
    header('Location: login.php');
    exit;
}

$tasks = $_SESSION['tasks'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?></title>
</head>
<body>
    <h1>Task Manager</h1>

    <form action="process_tasks.php" method="POST">
        <input type="text" name="task" placeholder="Add a new task" required>
        <button type="submit">Add Task</button>
    </form>

    <?php if (!empty($tasks)): ?>
        <h2>Your Tasks</h2>
        <ul style="list-style-type: none; padding-left: 0;">
            <?php foreach ($tasks as $index => $task): ?>
                <li style="margin-bottom: 5px">
                    <?= htmlspecialchars($task['task'], ENT_QUOTES, 'UTF-8'); ?>

                    <?php if (!$task['completed']): ?>
                        <form action="process_tasks.php" method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <button type="submit" name="completed">Mark completed</button>
                        </form>
                    <?php else: ?>
                        <strong style="color:green">concluded</strong>
                    <?php endif; ?>
                    <form action="process_tasks.php" method="POST" style="display: inline;">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="delete">delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <form action="process_tasks.php" method="POST" style="margin-top: 25px;">
            <button type="submit" name="clear">Clear All</button>
        </form>
    <?php endif; ?>
</body>
</html>