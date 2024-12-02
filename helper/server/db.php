<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "student_register";
$port = 3306;

$conn = mysqli_connect($hostname, $username, $password, $database, $port);
session_start();
if (!$conn) {
    die("เชื่อมต่อกับ database ไม่ได้" . mysqli_connect_error());
}
