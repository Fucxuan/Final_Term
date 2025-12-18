<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['registration_id'])) {
    header("Location: my_registrations.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];
$registration_id = (int) $_GET['registration_id'];

$sql = "
    UPDATE registrations
    SET status = 'cancelled'
    WHERE registration_id = $registration_id
      AND user_id = $user_id
";

mysqli_query($conn, $sql);

header("Location: my_registrations.php");
exit();
