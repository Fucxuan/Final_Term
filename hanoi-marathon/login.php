<?php
require "db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT * FROM users WHERE email = '$email'"
    );

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if ($error) { ?>
        <p class="message"><?= $error ?></p>
    <?php } ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <p>
        Don't have an account?  
        <a href="register.php">Register here</a>
    </p>
</div>

</body>
</html>
