<?php
// hapus.php
include 'koneksi.php';

if(isset($_GET['npm'])) {
    $npm = bersihkan($_GET['npm']);
    
    // Ambil nama untuk konfirmasi
    $query = mysqli_query($koneksi, "SELECT nama FROM mahasiswa WHERE npm='$npm'");
    $data = mysqli_fetch_array($query);
    
    if($data) {
        $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE npm='$npm'");
        
        if($hapus) {
            header("location:index.php?pesan=hapus");
        } else {
            header("location:index.php?pesan=error");
        }
    } else {
        header("location:index.php?pesan=error");
    }
} else {
    header("location:index.php");
}

mysqli_close($koneksi);
exit;
?>