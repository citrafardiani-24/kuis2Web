
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

<form method="post" enctype="multipart/form-data">
    <input name="fullname" placeholder="Nama Lengkap" required>
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="file" name="photo">
    <button type="submit">Register</button>
</form>
