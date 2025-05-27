<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5f7fa;
            padding: 30px;
        }
        h1 {
            text-align: center;
        }
        .top-actions {
            text-align: center;
            margin-bottom: 20px;
        }
        .top-actions a {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.action {
            margin: 0 5px;
            color: #007bff;
        }
        a.action:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <div class="top-actions">
        <a href="tambah_admin.php">Tambah Admin</a>
    </div>
    <table>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php while ($admin = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($admin['fullname']) ?></td>
            <td><?= htmlspecialchars($admin['username']) ?></td>
            <td><?= htmlspecialchars($admin['role']) ?></td>
            <td>
                <a class="action" href="edit_user.php?id=<?= $admin['id'] ?>">Edit</a>
                |
                <a class="action" href="crud.php?delete=<?= $admin['id'] ?>" onclick="return confirm('Yakin ingin hapus user ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
