<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: auth/login.php");

$role = $_SESSION['user']['role'];
if ($role == 'admin') {
    header("Location: admin/index.php");
} else {
    header("Location: user/profile.php");
}
?>
