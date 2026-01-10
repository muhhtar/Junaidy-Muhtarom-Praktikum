<?php
// koneksi.php - Modul 13
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_praktikum";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi keamanan
function bersihkan($data) {
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($koneksi, $data);
    return $data;
}

// Fungsi untuk menampilkan pesan
function tampilkanPesan() {
    if(isset($_SESSION['pesan'])) {
        $pesan = $_SESSION['pesan'];
        $tipe = $_SESSION['tipe_pesan'] ?? 'info';
        
        echo '<div class="pesan fade-in">';
        echo '<div class="' . $tipe . '">';
        echo '<i class="fas ' . ($tipe == 'success' ? 'fa-check-circle' : ($tipe == 'error' ? 'fa-exclamation-triangle' : 'fa-info-circle')) . '"></i> ';
        echo $pesan;
        echo '</div>';
        echo '</div>';
        
        // Hapus pesan setelah ditampilkan
        unset($_SESSION['pesan']);
        unset($_SESSION['tipe_pesan']);
    }
}

// Fungsi untuk set pesan
function setPesan($pesan, $tipe = 'info') {
    $_SESSION['pesan'] = $pesan;
    $_SESSION['tipe_pesan'] = $tipe;
}
?>