<?php
// tambah_mahasiswa.php
include 'koneksi.php';

$pesan = "";
$warna = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    
    $query = "INSERT INTO mahasiswa (npm, nama, alamat, kelas) 
              VALUES ('$npm', '$nama', '$alamat', '$kelas')";
    
    if (mysqli_query($koneksi, $query)) {
        $pesan = "Data mahasiswa berhasil ditambahkan!";
        $warna = "success";
    } else {
        $pesan = "Error: " . mysqli_error($koneksi);
        $warna = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #4a5568;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4a5568;
        }
        input[type="text"], select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
        }
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .btn:hover {
            background: #5a67d8;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
        .error { background: #fed7d7; color: #742a2a; border: 1px solid #fc8181; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Mahasiswa</h1>
        
        <?php if ($pesan): ?>
        <div class="alert <?php echo $warna; ?>">
            <?php echo $pesan; ?>
        </div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="npm">NPM:</label>
                <input type="text" id="npm" name="npm" required>
            </div>
            
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select id="kelas" name="kelas" required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="1A">1A</option>
                    <option value="1B">1B</option>
                    <option value="1C">1C</option>
                    <option value="2A">2A</option>
                    <option value="2B">2B</option>
                    <option value="2C">2C</option>
                </select>
            </div>
            
            <button type="submit" class="btn">Simpan Data</button>
        </form>
        
        <a href="tampil_mahasiswa.php" class="back-link">← Kembali ke Data Mahasiswa</a>
    </div>
</body>
</html>