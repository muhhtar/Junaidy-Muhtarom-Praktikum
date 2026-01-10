<?php
// input.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php';
    
    $npm = bersihkan($_POST['npm']);
    $nama = bersihkan($_POST['nama']);
    $alamat = bersihkan($_POST['alamat']);
    $kelas = bersihkan($_POST['kelas']);
    
    // Cek apakah NPM sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
    if(mysqli_num_rows($cek) > 0) {
        header("location:input.php?pesan=duplikat");
        exit;
    }
    
    $query = "INSERT INTO mahasiswa (npm, nama, alamat, kelas) VALUES ('$npm', '$nama', '$alamat', '$kelas')";
    
    if(mysqli_query($koneksi, $query)) {
        header("location:index.php?pesan=input");
    } else {
        header("location:input.php?pesan=error");
    }
    
    mysqli_close($koneksi);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Data Ke Database dengan PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="judul">
            <h1>Input Data Ke Database dengan PHP</h1>
            <h2>Menampilkan data dari database</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <div class="pesan">
            <?php
            if(isset($_GET['pesan'])){
                $pesan = $_GET['pesan'];
                if($pesan == "duplikat"){
                    echo '<div class="error"><i class="fas fa-exclamation-triangle"></i> NPM sudah terdaftar!</div>';
                } else if($pesan == "error"){
                    echo '<div class="error"><i class="fas fa-exclamation-triangle"></i> Gagal menyimpan data!</div>';
                }
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
                <i class="fas fa-user-plus"></i> Input Data Baru
            </h3>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="npm"><i class="fas fa-id-card"></i> NPM:</label>
                    <input type="text" id="npm" name="npm" required 
                           placeholder="Contoh: 17123454" maxlength="20">
                </div>
                
                <div class="form-group">
                    <label for="nama"><i class="fas fa-user"></i> Nama:</label>
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
                <a href="index.php" style="color: #3498db; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Mahasiswa
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Modul 12: Input Data ke Database dengan PHP</p>
        </div>
    </div>
</body>
</html>