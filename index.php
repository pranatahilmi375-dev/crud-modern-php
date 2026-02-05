<!DOCTYPE html>
<html>
<head>
    <title>CRUD Modern</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    
    <?php if (isset($_GET['status'])): ?>
    <div class="alert <?= $_GET['status'] == 'success' ? 'alert-success' : 'alert-error' ?>">
        <?= $_GET['message']; ?>
    </div>
    
<?php endif; ?>

    <?php
include 'includes/config.php';
;
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;


// query ke database
$result = mysqli_query($conn, "SELECT * FROM users");

// cek kalau query gagal
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
$search = "";

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $query = "SELECT * FROM users 
              WHERE name LIKE '%$search%' 
                 OR email LIKE '%$search%' 
                 OR phone LIKE '%$search%'
              ORDER BY id DESC
              LIMIT $start, $limit";
} else {
    $query = "SELECT * FROM users 
              ORDER BY id DESC 
              LIMIT $start, $limit";
}

$result = mysqli_query($conn, $query);
if ($search != "") {
    $result_count = mysqli_query($conn, 
        "SELECT COUNT(*) AS total FROM users 
         WHERE name LIKE '%$search%' 
            OR email LIKE '%$search%' 
            OR phone LIKE '%$search%'"
    );
} else {
    $result_count = mysqli_query($conn, 
        "SELECT COUNT(*) AS total FROM users"
    );
}

$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];
$total_pages = ceil($total_data / $limit);

?>


<div class="navbar">Aplikasi CRUD Modern</div>
<div class="container">

    <a href="create.php" class="btn btn-add">+ Tambah Data</a>
<form method="GET" style="margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Cari name / email / no HP" 
           value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" 
           style="padding: 8px; width: 250px;">
    <button type="submit" class="btn btn-add">Cari</button>
    <div class="export-wrapper">
    <a href="export_excel.php" class="export-btn excel">
        📊 Excel
    </a>
    <a href="export_pdf.php" class="export-btn pdf">
        📄 PDF
    </a>
    <a href="export_word.php" class="export-btn word">
        📝 Word
    </a>
</div>

    
</form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['phone']; ?></td>
            <td>
                <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
    <div style="margin-top: 20px;">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>&search=<?= $search ?>" 
           class="btn <?= $i == $page ? 'btn-edit' : 'btn-add' ?>"
           style="margin-right: 5px;">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>


</div>

</body>
</html>
