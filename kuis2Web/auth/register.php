<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $photo = '';
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = uniqid() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$photo");
    }

    $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, role, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $username, $password, $role, $photo);
    $stmt->execute();

    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <style>
        body {
            background: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: sans-serif;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2 style="text-align:center; margin-bottom:20px;">Daftar Akun</h2>
        <input name="fullname" placeholder="Nama Lengkap" required>
        <input name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="file" name="photo">
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
