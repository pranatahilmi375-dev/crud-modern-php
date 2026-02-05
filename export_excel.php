<?php
include 'includes/config.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=users.xls");

echo "<table border='1'>";
echo "
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
</tr>
";

$query = mysqli_query($conn, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($query)) {
    echo "
    <tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
        <td>".$row['phone']."</td>
    </tr>
    ";
}

echo "</table>";
?>
