<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: login.php');
    exit;
}

echo "Welcome, " . $_SESSION['user_name'] . "!";
?>
