<?php
$conn = mysqli_connect("localhost", "root", "", "portofolio");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>