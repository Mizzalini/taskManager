<?php

require_once __DIR__ . '/../bootstrap.php';

unset($_SESSION['userLogged']);
unset($_SESSION['login_attempts']);

header("Location: login.php");
exit;
?>