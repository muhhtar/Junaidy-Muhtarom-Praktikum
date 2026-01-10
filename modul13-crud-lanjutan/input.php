<?php
// input.php - Modul 13
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $npm = bersihkan($_POST['npm']);
    $nama = bersihkan($_POST['nama']);
    $alamat = bersihkan($_POST['alamat']);
    $kelas = bersihkan($_POST['kelas']);
    
    // Cek duplikat NPM
    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
    if(mysqli_num_rows($cek) > 0) {
        setPesan('NPM <strong>' . $npm . '</strong> sudah terdaftar!', 'error');
        header('location: input.php');
        exit;
    }
    
    // Insert data
    $query = "INSERT INTO mahasiswa (npm, nama, alamat, kelas) 
              VALUES ('$npm', '$nama', '$alamat', '$kelas')";
    
    if(mysqli_query($koneksi, $query)) {
        setPesan('Data <strong>' . $nama . '</strong> berhasil di input!', 'success');
        header('location: index.php');
    } else {
        setPesan('Gagal menyimpan data: ' . mysqli_error($koneksi), 'error');
        header('location: input.php');
    }
    
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Data Baru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container fade-in">
        <div class="judul">
            <h1><i class="fas fa-database"></i> Input Data Ke Database dengan PHP</h1>
            <h2>Menambahkan data baru ke database</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <?php tampilkanPesan(); ?>
        
        <div class="link-container">
            <a class="tombol kembali" href="index.php">
                <i class="fas fa-arrow-left"></i> Lihat Semua Data
            </a>
        </div>
        
        <div class="form-container">
            <h2 style="color: #4A00E0; text-align: center; margin-bottom: 30px;">
                <i class="fas fa-user-plus"></i> Input Data Baru
            </h2>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="npm"><i class="fas fa-id-card"></i> NPM:</label>
                    <input type="text" id="npm" name="npm" required 
                           placeholder="Contoh: 17123454" pattern="[0-9]+" 
                           title="Hanya angka diperbolehkan" maxlength="20">
                    <small style="color: #6c757d; display: block; margin-top: 5px;">
                        Masukkan NPM (hanya angka)
                    </small>
                </div>
                
                <div class="form-group">
                    <label for="nama"><i class="fas fa-user"></i> Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" required 
                           placeholder="Contoh: Jatmiko">
                </div>
                
                <div class="form-group">
                    <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required 
                           placeholder="Contoh: Jl. Bogorejo">
                </div>
                
                <div class="form-group">
                    <label for="kelas"><i class="fas fa-graduation-cap"></i> Kelas:</label>
                    <select id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                        <option value="2C">2C</option>
                        <option value="3A">3A</option>
                        <option value="3B">3B</option>
                        <option value="3C">3C</option>
                        <option value="9A">9A</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-simpan">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </form>
            
            <div class="link-container">
                <a href="index.php" style="color: #4A00E0; text-decoration: none;">
                    <i class="fas fa-times"></i> Batalkan Input
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Form Input Data Baru | Modul 13: Update dan Delete Data</p>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($koneksi); ?>