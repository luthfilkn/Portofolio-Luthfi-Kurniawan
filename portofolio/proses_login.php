<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); // MD5 digunakan sesuai yang dimasukkan di database

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header("Location: admin.php");
} else {
    header("Location: login.php?error=Username atau password salah!");
}
?>
