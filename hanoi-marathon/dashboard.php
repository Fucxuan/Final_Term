<?php
require "db.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['full_name'] ?? 'User';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
    <h2>Welcome, <?= htmlspecialchars($user_name) ?> 👋</h2>

    <p>
        This is your dashboard. From here you can:
    </p>

    <ul>
        <li>View available marathon events</li>
        <li>Register for a marathon</li>
        <li>View or cancel your registrations</li>
    </ul>

    <hr>

    <h3>Quick Links</h3>
    <p>
        👉 <a href="marathon_list.php">View Marathon List</a><br><br>
        👉 <a href="my_registrations.php">My Registrations</a>
    </p>
</div>

</body>
</html>
