<?php
session_start();
include '../config/db.php';

$user = $_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $photo = $user['photo'];

    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = uniqid() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$photo");
    }

    $stmt = $conn->prepare("UPDATE users SET fullname=?, photo=? WHERE id=?");
    $stmt->bind_param("ssi", $fullname, $photo, $user['id']);
    $stmt->execute();

    $_SESSION['user']['fullname'] = $fullname;
    $_SESSION['user']['photo'] = $photo;
    header("Location: profile.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <style>
        body {
            background: #f0f2f5;
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2 style="text-align:center; margin-bottom:20px;">Edit Profil</h2>
        <input name="fullname" value="<?= $user['fullname'] ?>" required>
        <input type="file" name="photo">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
