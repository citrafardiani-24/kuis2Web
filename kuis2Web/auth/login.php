<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role=?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Login gagal";
    }
}
?>
<form method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <select name="role" required>
        <option value="user">Login sebagai User</option>
        <option value="admin">Login sebagai Admin</option>
    </select>
    <button type="submit">Login</button>
</form>
<a href="register.php">Register</a>