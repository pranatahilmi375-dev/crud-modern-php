<?php
include 'includes/config.php';
;

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $result = mysqli_query($conn, "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')");

    if ($result) {
        header("Location: index.php?status=success&message=Data berhasil ditambahkan");
    } else {
        header("Location: index.php?status=error&message=Gagal menambahkan data");
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
</body>
</html>
