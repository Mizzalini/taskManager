<?php
declare(strict_types= 1);
include_once 'config_global.php';

$error = "";

if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['login'])) {
    if (!hash_equals($_COOKIE['csrf_token'], $_POST['csrf_token'])) {
        exit("Invalid token.");
    }

    onLogin(user: $_POST['user'], pass: $_POST['pass']);
}

function onLogin(string $user, string $pass): void {
    if (validate($user, $pass) === false) {
        return;
    }

    createSession();
    redirectUserLogged();
}

function validate(string $user, string $pass): bool {
    global $error;

    if (empty($user) || empty($pass)) {
        $error = "User and password are required.";
        return false;
    }

    if (!hash_equals($user, USER) || !hash_equals($pass, PASS)) {
        $error = "User or password is incorrect.";
        return false;
    }

    return true;
}

function createSession(): void {
    $_SESSION['userLogged'] = true;
}

function redirectUserLogged(): void {
    header("Location: index.php");
}