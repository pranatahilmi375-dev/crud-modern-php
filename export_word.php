<?php
include 'includes/config.php';

header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=users.doc");

echo "<h2>Data Users</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
</tr>";

$result = mysqli_query($conn, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
        <td>".$row['phone']."</td>
    </tr>";
}

echo "</table>";
?>
