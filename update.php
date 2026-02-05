<?php
include 'includes/config.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id");
    if ($result) {
    header("Location: index.php?status=success&message=Data berhasil dihapus");
} else {
    header("Location: index.php?status=error&message=Gagal menghapus data");



    header("Location: index.php");
}
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="assets/style.css">

<div class="navbar">Form Tambah Data</div>

<div class="card">
    <h2>Tambah Data</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="No HP" required>

        <button type="submit" name="submit">Simpan</button>
    </form>
</div>
</html>
