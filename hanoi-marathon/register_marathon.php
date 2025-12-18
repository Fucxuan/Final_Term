<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* LẤY marathon_id TỪ GET */
if (!isset($_GET['marathon_id'])) {
    die("Invalid request: missing marathon_id");
}

$marathon_id = (int) $_GET['marathon_id'];
$user_id = (int) $_SESSION['user_id'];

/* LẤY THÔNG TIN GIẢI */
$marathon_query = mysqli_query($conn,
    "SELECT * FROM marathons WHERE marathon_id = $marathon_id"
);
$marathon = mysqli_fetch_assoc($marathon_query);

if (!$marathon) {
    die("Marathon not found");
}

/* KHI SUBMIT FORM */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $age = (int) $_POST['age'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    /* CẬP NHẬT USER */
    mysqli_query($conn, "
        UPDATE users SET
            nationality = '$nationality',
            sex = '$sex',
            age = $age,
            phone = '$phone'
        WHERE user_id = $user_id
    ");

    /* KIỂM TRA ĐÃ ĐĂNG KÝ CHƯA */
    $check = mysqli_query($conn, "
        SELECT * FROM registrations
        WHERE user_id = $user_id
          AND marathon_id = $marathon_id
    ");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "
            INSERT INTO registrations (user_id, marathon_id, status)
            VALUES ($user_id, $marathon_id, 'registered')
        ");
    }

    header("Location: my_registrations.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Marathon</title>
</head>
<body>

<h2>Register for <?= htmlspecialchars($marathon['marathon_name']) ?></h2>

<form method="post">

    <!-- GIỮ marathon_id KHI POST -->
    <input type="hidden" name="marathon_id" value="<?= $marathon_id ?>">

    Nationality:<br>
    <input type="text" name="nationality" required><br><br>

    Sex:<br>
    <select name="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br><br>

    Age:<br>
    <input type="number" name="age" min="1" required><br><br>

    Phone:<br>
    <input type="text" name="phone" required><br><br>

    <button type="submit">Confirm Registration</button>
</form>

<br>
<a href="marathon_list.php">Back</a>

</body>
</html>
