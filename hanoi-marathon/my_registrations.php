<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$sql = "
    SELECT 
        r.registration_id,
        r.status,
        m.marathon_name,
        m.marathon_date
    FROM registrations r
    JOIN marathons m 
        ON r.marathon_id = m.marathon_id
    WHERE r.user_id = $user_id
      AND r.status = 'registered'
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registrations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>My Marathon Registrations</h2>

<?php if (mysqli_num_rows($result) == 0) { ?>
    <p><strong>You have no active marathon registrations.</strong></p>
<?php } else { ?>

<table border="1" cellpadding="10">
<tr>
    <th>Marathon</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= htmlspecialchars($row['marathon_name']) ?></td>
    <td><?= $row['marathon_date'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <a href="cancel_registration.php?registration_id=<?= $row['registration_id'] ?>"
           onclick="return confirm('Are you sure you want to cancel this registration?');">
           Cancel
        </a>

    </td>
</tr>
<?php } ?>

</table>

<?php } ?>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
