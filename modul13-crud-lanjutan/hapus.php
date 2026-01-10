<?php
// hapus.php - Modul 13
include 'koneksi.php';

if(!isset($_GET['npm'])) {
    setPesan('NPM tidak ditemukan!', 'error');
    header('location: index.php');
    exit;
}

$npm = bersihkan($_GET['npm']);

// Ambil data untuk konfirmasi (opsional)
$query = mysqli_query($koneksi, "SELECT nama FROM mahasiswa WHERE npm='$npm'");
$data = mysqli_fetch_array($query);

if(!$data) {
    setPesan('Data tidak ditemukan!', 'error');
    header('location: index.php');
    exit;
}

// Hapus data
$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE npm='$npm'");

if($hapus) {
    setPesan('Data <strong>' . $data['nama'] . '</strong> berhasil di hapus!', 'success');
} else {
    setPesan('Gagal menghapus data: ' . mysqli_error($koneksi), 'error');
}

mysqli_close($koneksi);
header('location: index.php');
exit;
?>