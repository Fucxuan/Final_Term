<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "
    SELECT 
        m.marathon_id,
        m.marathon_name,
        m.marathon_date,
        m.status,
        (
            SELECT COUNT(*) 
            FROM registrations r 
            WHERE r.user_id = $user_id 
              AND r.marathon_id = m.marathon_id
              AND r.status = 'registered'
        ) AS is_registered
    FROM marathons m
    WHERE m.status = 'scheduled'
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marathon List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="marathon_list.php">Marathons</a>
    <a href="my_registrations.php">My Registrations</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Available Marathons</h2>

<table>
<tr>
    <th>Name</th>
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
        <?php if ($row['is_registered'] > 0) { ?>
            <strong>Registered</strong>
        <?php } else { ?>
            <a href="register_marathon.php?marathon_id=<?= $row['marathon_id'] ?>">
                Register
            </a> 
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
