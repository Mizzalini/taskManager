<?php
session_start();

unset($_SESSION['userLogged']);

echo "User login reset.";
?>