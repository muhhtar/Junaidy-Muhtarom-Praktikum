<?php
// edit.php
include 'koneksi.php';

$npm = isset($_GET['npm']) ? bersihkan($_GET['npm']) : '';

// Ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
$data = mysqli_fetch_array($query);

if (!$data) {
    header("location:index.php?pesan=error");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = bersihkan($_POST['nama']);
    $alamat = bersihkan($_POST['alamat']);
    $kelas = bersihkan($_POST['kelas']);
    
    $update = "UPDATE mahasiswa SET nama='$nama', alamat='$alamat', kelas='$kelas' WHERE npm='$npm'";
    
    if(mysqli_query($koneksi, $update)) {
        header("location:index.php?pesan=update");
    } else {
        header("location:edit.php?npm=$npm&pesan=error");
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="judul">
            <h1>Edit Data Mahasiswa</h1>
            <h2>Update data di database</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <div class="pesan">
            <?php
            if(isset($_GET['pesan']) && $_GET['pesan'] == "error"){
                echo '<div class="error"><i class="fas fa-exclamation-triangle"></i> Gagal mengupdate data!</div>';
            }
            ?>
        </div>
        
        <div class="link-container">
            <a class="tombol kembali" href="index.php">
                <i class="fas fa-database"></i> Lihat Semua Data
            </a>
        </div>
        
        <div class="form-container">
            <h3 style="color: #2c3e50; margin-bottom: 30px; text-align: center;">
                <i class="fas fa-user-edit"></i> Edit Data Mahasiswa
            </h3>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="npm"><i class="fas fa-id-card"></i> NPM:</label>
                    <input type="text" id="npm" value="<?php echo $data['npm']; ?>" readonly 
                           style="background: #f0f0f0;">
                </div>
                
                <div class="form-group">
                    <label for="nama"><i class="fas fa-user"></i> Nama:</label>
                    <input type="text" id="nama" name="nama" required 
                           value="<?php echo $data['nama']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required 
                           value="<?php echo $data['alamat']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="kelas"><i class="fas fa-graduation-cap"></i> Kelas:</label>
                    <select id="kelas" name="kelas" required>
                        <option value="1A" <?php echo ($data['kelas']=='1A')?'selected':''; ?>>1A</option>
                        <option value="1B" <?php echo ($data['kelas']=='1B')?'selected':''; ?>>1B</option>
                        <option value="1C" <?php echo ($data['kelas']=='1C')?'selected':''; ?>>1C</option>
                        <option value="2A" <?php echo ($data['kelas']=='2A')?'selected':''; ?>>2A</option>
                        <option value="2B" <?php echo ($data['kelas']=='2B')?'selected':''; ?>>2B</option>
                        <option value="2C" <?php echo ($data['kelas']=='2C')?'selected':''; ?>>2C</option>
                        <option value="3A" <?php echo ($data['kelas']=='3A')?'selected':''; ?>>3A</option>
                        <option value="3B" <?php echo ($data['kelas']=='3B')?'selected':''; ?>>3B</option>
                        <option value="3C" <?php echo ($data['kelas']=='3C')?'selected':''; ?>>3C</option>
                        <option value="9A" <?php echo ($data['kelas']=='9A')?'selected':''; ?>>9A</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-simpan">
                    <i class="fas fa-sync-alt"></i> Update Data
                </button>
            </form>
            
            <div class="link-container">
                <a href="index.php" style="color: #3498db; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Kembali tanpa menyimpan
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Modul 12: Edit Data Mahasiswa</p>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($koneksi); ?>