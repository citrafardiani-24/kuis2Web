
<?php
session_start();
$user = $_SESSION['user'];
$photo = $user['photo'] ? '../uploads/' . $user['photo'] : '../uploads/default.png';
?>
<h1>Profil Pengguna</h1>
<img src="<?= $photo ?>" width="150"><br>
Nama: <?= $user['fullname'] ?><br>
Username: <?= $user['username'] ?><br>
<a href="update_profile.php">Edit Profil</a>
