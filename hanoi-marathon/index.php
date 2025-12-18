<?php
require "db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hanoi Marathon System</title>
</head>
<body>

<h1>Hanoi Marathon Registration System</h1>

<p>
This system allows users to view upcoming marathons and register online.
</p>

<ul>
    <li><a href="login.php">Login</a></li>
    <li><a href="register_user.php">Register</a></li>
</ul>

</body>
</html>
