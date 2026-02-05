<?php
include 'includes/config.php';
;

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
if ($result) {
    header("Location: index.php?status=success&message=Data berhasil dihapus");
} else {
    header("Location: index.php?status=error&message=Gagal menghapus data");
}


header("Location: index.php");
?>
