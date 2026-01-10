<?php
// edit.php - Modul 13
include 'koneksi.php';

if(!isset($_GET['npm'])) {
    setPesan('NPM tidak ditemukan!', 'error');
    header('location: index.php');
    exit;
}

$npm = bersihkan($_GET['npm']);

// Ambil data yang akan diedit
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
$data = mysqli_fetch_array($query);

if(!$data) {
    setPesan('Data tidak ditemukan!', 'error');
    header('location: index.php');
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
    <div class="container fade-in">
        <div class="judul">
            <h1><i class="fas fa-edit"></i> Update Data di Database dengan PHP</h1>
            <h2>Edit data dari database</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <div class="link-container">
            <a class="tombol kembali" href="index.php">
                <i class="fas fa-arrow-left"></i> Lihat Semua Data
            </a>
        </div>
        
        <div class="form-container">
            <h2 style="color: #4A00E0; text-align: center; margin-bottom: 30px;">
                <i class="fas fa-user-edit"></i> Edit Data Mahasiswa
            </h2>
            
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="npm"><i class="fas fa-id-card"></i> NPM:</label>
                    <input type="text" id="npm" name="npm" value="<?php echo $data['npm']; ?>" 
                           readonly style="background: #f8f9fa;">
                    <small style="color: #6c757d; display: block; margin-top: 5px;">
                        NPM tidak dapat diubah
                    </small>
                </div>
                
                <div class="form-group">
                    <label for="nama"><i class="fas fa-user"></i> Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" 
                           required placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" 
                           required placeholder="Masukkan alamat lengkap">
                </div>
                
                <div class="form-group">
                    <label for="kelas"><i class="fas fa-graduation-cap"></i> Kelas:</label>
                    <select id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
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
                
                <button type="submit" class="btn-simpan btn-update">
                    <i class="fas fa-sync-alt"></i> Update Data
                </button>
            </form>
            
            <div class="link-container">
                <a href="index.php" style="color: #4A00E0; text-decoration: none; font-weight: bold;">
                    <i class="fas fa-times"></i> Batalkan Edit
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Form Edit Data | Data yang diedit: <?php echo $data['nama']; ?> (<?php echo $data['npm']; ?>)</p>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($koneksi); ?>