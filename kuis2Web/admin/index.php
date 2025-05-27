<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$result = $conn->query("SELECT * FROM users");
?>
<a href="tambah_admin.php">Tambah Admin</a>
<table border="1">
    <tr><th>Nama</th><th>Username</th><th>Role</th><th>Aksi</th></tr>
    <?php while ($admin = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($admin['fullname']) ?></td>
            <td><?= htmlspecialchars($admin['username']) ?></td>
            <td><?= htmlspecialchars($admin['role']) ?></td>
            <td>
                <a href="edit_user.php?id=<?= $admin['id'] ?>">Edit</a> |
                <a href="crud.php?delete=<?= $admin['id'] ?>" onclick="return confirm('Yakin ingin hapus user ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>