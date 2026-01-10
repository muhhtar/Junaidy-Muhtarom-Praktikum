<!DOCTYPE html>
<html>
<head>
    <title>Tugas String dan Tanggal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px;
            color: #333;
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
        .instruction {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #4299e1;
            margin-bottom: 25px;
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
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        .btn-submit {
            background: #667eea;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: #5a67d8;
        }
        .result-box {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            background: #f0fff4;
            border-left: 4px solid #48bb78;
        }
        .error-box {
            background: #fff5f5;
            border-left: 4px solid #f56565;
        }
        .date-info {
            background: #e6fffa;
            border-left: 4px solid #38b2ac;
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tugas Praktikum Modul 10</h1>
        
        <div class="instruction">
            <strong>Petunjuk:</strong> Masukkan Nama, Email dan Password<br>
            Default: Nama = <strong>belajar</strong>, Email = <strong>test@gmail.com</strong>, Password = <strong>madium</strong>
        </div>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" 
                       value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" 
                       placeholder="Masukkan nama">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                       placeholder="Masukkan email">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" 
                       placeholder="Masukkan password">
            </div>
            
            <button type="submit" class="btn-submit" name="submit">Cek Validasi</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
            echo '<div class="result-box">';
            echo '<h3>Hasil Validasi:</h3>';
            
            // VALIDASI EMAIL
            if (empty($email)) {
                echo '<div class="error-box">';
                echo '<strong>Error:</strong> Harap mengisi email<br>';
                echo '</div>';
            } else {
                // Menggunakan filter_var untuk validasi email modern
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Cek apakah email adalah test@gmail.com
                    if ($email == "test@gmail.com") {
                        echo '<strong>✓ Email:</strong> Alamat email <strong>' . htmlspecialchars($email) . '</strong> valid (sesuai default)<br>';
                    } else {
                        echo '<strong>✓ Email:</strong> Alamat email <strong>' . htmlspecialchars($email) . '</strong> valid<br>';
                    }
                } else {
                    echo '<div class="error-box">';
                    echo '<strong>✗ Email:</strong> Alamat email <strong>' . htmlspecialchars($email) . '</strong> tidak valid<br>';
                    echo '</div>';
                }
            }
            
            // VALIDASI PASSWORD
            if (!empty($password)) {
                $nama_default = "belajar";
                $pass_default = "madium";
                
                // Enkripsi password dengan salt (nama)
                $pass_valid_hash = crypt($pass_default, $nama_default);
                $input_hash = crypt($password, $nama_default);
                
                if ($pass_valid_hash === $input_hash) {
                    echo '<strong>✓ Password:</strong> Password valid (sesuai default)<br>';
                } else {
                    echo '<div class="error-box">';
                    echo '<strong>✗ Password:</strong> Password salah<br>';
                    echo '</div>';
                }
            } else {
                echo '<div class="error-box">';
                echo '<strong>✗ Password:</strong> Password belum diisi<br>';
                echo '</div>';
            }
            
            // INFORMASI STRING (Nama)
            if (!empty($nama)) {
                echo '<hr>';
                echo '<h4>Informasi String (Nama):</h4>';
                echo 'Panjang nama: <strong>' . strlen($nama) . '</strong> karakter<br>';
                echo 'Nama dalam uppercase: <strong>' . strtoupper($nama) . '</strong><br>';
                echo 'Nama dalam lowercase: <strong>' . strtolower($nama) . '</strong><br>';
                echo 'Karakter pertama: <strong>' . substr($nama, 0, 1) . '</strong><br>';
            }
            
            echo '</div>'; // Tutup result-box
        }
        ?>
        
        <div class="date-info">
            <h3>Fungsi Tanggal dan Waktu (Date & Time):</h3>
            <?php
            date_default_timezone_set('Asia/Jakarta');
            
            echo 'Tanggal sekarang: <strong>' . date('d-m-Y') . '</strong><br>';
            echo 'Hari ini: <strong>' . date('l') . '</strong><br>';
            echo 'Waktu sekarang: <strong>' . date('H:i:s') . '</strong><br>';
            echo 'Format lengkap: <strong>' . date('l, d F Y H:i:s') . '</strong><br>';
            
            // Contoh manipulasi tanggal
            $besok = date('d-m-Y', strtotime('+1 day'));
            echo 'Besok tanggal: <strong>' . $besok . '</strong><br>';
            ?>
            
            <hr>
            <h4>Contoh Fungsi String:</h4>
            <?php
            $contoh_string = "Pemrograman Web dengan PHP";
            echo 'String asli: <strong>"' . $contoh_string . '"</strong><br>';
            echo 'Jumlah kata: <strong>' . str_word_count($contoh_string) . '</strong><br>';
            echo 'Posisi kata "Web": <strong>' . strpos($contoh_string, "Web") . '</strong><br>';
            echo 'Substring (karakter 0-12): <strong>"' . substr($contoh_string, 0, 12) . '"</strong><br>';
            ?>
        </div>
    </div>
</body>
</html>