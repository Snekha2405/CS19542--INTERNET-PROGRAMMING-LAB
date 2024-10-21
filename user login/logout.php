<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: home.html"); // Redirect to main page
    exit();
?>

