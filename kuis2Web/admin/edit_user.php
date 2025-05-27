<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET fullname=?, username=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $fullname, $username, $role, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<form method="post">
    <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    <select name="role" required>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select>
    <button type="submit">Update</button>
</form>
