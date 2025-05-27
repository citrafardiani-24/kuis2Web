<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $fullname, $username, $password);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<form method="post">
    <input type="text" name="fullname" placeholder="Nama Lengkap" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Tambah Admin</button>
</form>