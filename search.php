<?php
include 'includes/config.php';

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $query = "SELECT * FROM users WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
} else {
    $result = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
</head>
<body>

<h2>Hasil Pencarian Data</h2>

<form method="GET" action="search.php">
    <input type="text" name="keyword" placeholder="Cari data..." value="<?= $keyword ?>">
    <button type="submit">Cari</button>
</form>

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>phone</th>
    </tr>

    <?php if(isset($_GET['keyword'])): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td>
                <a href="update.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php endif; ?>

</table>

<br>
<a href="index.php">Kembali</a>

</body>
</html>