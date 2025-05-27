<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $check = $conn->query("SELECT role FROM users WHERE id=$id");
    $data = $check->fetch_assoc();

    if ($data['role'] !== 'admin') {
        $conn->query("DELETE FROM users WHERE id=$id");
    }

    header("Location: index.php");
    exit;
}
?>