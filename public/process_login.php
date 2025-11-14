<?php

require_once __DIR__ . '/../bootstrap.php';

use App\Auth\Authenticator;

if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['login'])) {

    if (!hash_equals($_COOKIE['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['error'] = "Your security token was invalid. Please try submitting the form again.";
        header("Location: login.php");
        exit;
    }

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SESSION['login_attempts'] >= 5) {
        $_SESSION['error'] = "You have made too many attempts. Please try again later.";
        header("Location: login.php");
        exit;
    }

    Authenticator::onLogin(user: $_POST['user'], pass: $_POST['pass']);
} else {
    header("Location: login.php");
    exit;
}