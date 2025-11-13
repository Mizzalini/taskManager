<?php
declare(strict_types= 1);
include_once 'config_global.php';

if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['login'])) {
    if (!hash_equals($_COOKIE['csrf_token'], $_POST['csrf_token'])) {
        exit("Invalid token.");
    }

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SESSION['login_attempts'] >= 5) {
        $error = "You have made too many attempts. Please try again later.";
    } else {
        onLogin(user: $_POST['user'], pass: $_POST['pass']);
    }
}

/**
 * Orchestrates the login attempt
 * 
 * @param string $user The username submitted to the form
 * @param string $pass The password submitted to the form
 */
function onLogin(string $user, string $pass): void {
    $error = validate($user, $pass);

    if ($error !== true) {
        $_SESSION['login_attempts']++;
        $_SESSION['error'] = $error;
        header("Location: login.php");
        exit;
    }

    $_SESSION['login_attempts'] = 0;

    createSession();
    redirectUserLogged();
}

/**
 * Validates the user's credentials
 * 
 * @param string $user The username to check
 * @param string $pass The password to check
 * @return bool|string Returns 'true' on success, or an error on failure
 */
function validate(string $user, string $pass): bool|string {
    if (empty($user) || empty($pass)) {
        return "User and password are required.";
    }

    if (!hash_equals($user, USER) || !hash_equals($pass, PASS)) {
        return "User or password is incorrect.";
    }

    return true;
}

function createSession(): void {
    $_SESSION['userLogged'] = true;
}

function redirectUserLogged(): void {
    header("Location: index.php");
    exit;
}