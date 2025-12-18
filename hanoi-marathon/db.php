<?php
$conn = mysqli_connect("localhost", "root", "", "hanoi_marathon");

if (!$conn) {
    die("Database connection failed");
}

session_start();
