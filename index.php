<?php
session_start();

// Redirect to login form if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// If user is logged in, redirect to main event management system
header("Location: events.php");
exit();
?>
