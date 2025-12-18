<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}


$user_id = 1; // demo

$result = mysqli_query($conn,
    "SELECT m.name, r.status
     FROM registrations r
     JOIN marathons m ON r.marathon_id = m.id
     WHERE r.user_id = $user_id"
);
?>

<h2>My Marathon Status</h2>

<table border="1">
<tr>
    <th>Marathon</th>
    <th>Status</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>
</table>
