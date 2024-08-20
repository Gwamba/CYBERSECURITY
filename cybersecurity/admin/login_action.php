<?php
session_start();
// Dummy credentials check (replace with actual database verification)
$valid_username = "admin";
$valid_password = "password";

if ($_POST['username'] === $valid_username && $_POST['password'] === $valid_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin.php");
    exit;
} else {
    $_SESSION['login_error'] = "Invalid username or password.";
    header("Location: login.php");
    exit;
}
?>
