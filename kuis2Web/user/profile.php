<?php
session_start();
$user = $_SESSION['user'];
$photo = $user['photo'] ? '../uploads/' . $user['photo'] : '../uploads/default.png';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <style>
        body {
            background: #f7f9fc;
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .profile-box {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .profile-box img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .profile-box h2 {
            margin-top: 15px;
            font-size: 24px;
        }
        .profile-box p {
            color: #555;
        }
        .profile-box a {
            display: inline-block;
            margin-top: 20px;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }
        .profile-box a:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="profile-box">
        <img src="<?= $photo ?>" alt="Foto Profil">
        <h2><?= $user['fullname'] ?></h2>
        <p><strong>Username:</strong> <?= $user['username'] ?></p>
        <a href="update_profile.php">Edit Profil</a>
    </div>
</body>
</html>
