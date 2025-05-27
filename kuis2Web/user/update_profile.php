
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

<form method="post" enctype="multipart/form-data">
    <input name="fullname" value="<?= $user['fullname'] ?>" required>
    <input type="file" name="photo">
    <button type="submit">Simpan</button>
</form>
