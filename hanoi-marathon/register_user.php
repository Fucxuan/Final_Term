<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists";
    } else {
        mysqli_query($conn,
            "INSERT INTO users (full_name, email, password, role)
             VALUES ('$name','$email','$password','participant')"
        );
        header("Location: login.php");
    }
}
?>

<h2>User Registration</h2>

<form method="post">
    Full name: <br>
    <input type="text" name="full_name" required><br><br>

    Email: <br>
    <input type="email" name="email" required><br><br>

    Password: <br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<p style="color:red"><?= $error ?? "" ?></p>

<a href="login.php">Login</a>
