<?php
// update.php - Modul 13
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $npm = bersihkan($_POST['npm']);
    $nama = bersihkan($_POST['nama']);
    $alamat = bersihkan($_POST['alamat']);
    $kelas = bersihkan($_POST['kelas']);
    
    // Cek apakah data ada
    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
    if(mysqli_num_rows($cek) == 0) {
        setPesan('Data tidak ditemukan!', 'error');
        header('location: index.php');
        exit;
    }
    
    // Update data
    $query = "UPDATE mahasiswa SET 
              nama='$nama', 
              alamat='$alamat', 
              kelas='$kelas' 
              WHERE npm='$npm'";
    
    if(mysqli_query($koneksi, $query)) {
        setPesan('Data berhasil di update!', 'success');
    } else {
        setPesan('Gagal mengupdate data: ' . mysqli_error($koneksi), 'error');
    }
    
    mysqli_close($koneksi);
    header('location: index.php');
    exit;
} else {
    header('location: index.php');
    exit;
}
?>