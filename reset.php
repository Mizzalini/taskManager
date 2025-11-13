<?php
session_start();

unset($_SESSION['userLogged']);
unset($_SESSION['login_attempts']);

echo "User login reset.";
?>