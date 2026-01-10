<?php
// koneksi.php
$host = "localhost";
$user = "root";  // Ganti jika berbeda
$pass = "";      // Ganti jika ada password
$db   = "db_praktikum";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>