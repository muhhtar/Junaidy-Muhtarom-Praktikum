<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Modul 11</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #333;
            padding: 30px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }
        
        h1 {
            font-size: 2.8rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            margin-bottom: 40px;
        }
        
        .card h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card h2 i {
            color: #3498db;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background: #3498db;
            color: white;
            padding: 18px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        td {
            padding: 18px;
            border-bottom: 1px solid #eee;
        }
        
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        tr:hover {
            background: #e3f2fd;
            transition: background 0.3s;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        
        .badge-a {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-b {
            background: #fff3cd;
            color: #856404;
        }
        
        .badge-c {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        .menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 30px;
        }
        
        .menu-item {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }
        
        .menu-item:hover {
            transform: translateY(-10px);
            border-color: #3498db;
            box-shadow: 0 15px 30px rgba(52, 152, 219, 0.3);
        }
        
        .menu-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: block;
        }
        
        .menu-1 .menu-icon { color: #e74c3c; }
        .menu-2 .menu-icon { color: #2ecc71; }
        .menu-3 .menu-icon { color: #f39c12; }
        
        .menu-item h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
        
        .menu-item p {
            color: #7f8c8d;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }
        
        .btn:hover {
            background: #2980b9;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #3498db;
            color: #3498db;
        }
        
        .btn-outline:hover {
            background: #3498db;
            color: white;
        }
        
        .footer {
            text-align: center;
            margin-top: 50px;
            color: white;
            padding: 20px;
            opacity: 0.8;
        }
        
        @media (max-width: 992px) {
            .menu {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .menu {
                grid-template-columns: 1fr;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-database"></i> Modul 11: Database dengan PHP</h1>
            <p class="subtitle">Membuat Database dan Menampilkannya dalam Website</p>
        </header>
        
        <div class="card">
            <h2><i class="fas fa-users"></i> Data Mahasiswa</h2>
            
            <?php
            include 'koneksi.php';
            
            $query = "SELECT * FROM mahasiswa ORDER BY kelas, nama";
            $result = mysqli_query($koneksi, $query);
            
            if (mysqli_num_rows($result) > 0) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $badge_class = '';
                        if (strpos($row['kelas'], 'A') !== false) $badge_class = 'badge-a';
                        elseif (strpos($row['kelas'], 'B') !== false) $badge_class = 'badge-b';
                        else $badge_class = 'badge-c';
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo $row['npm']; ?></strong></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><span class="badge <?php echo $badge_class; ?>"><?php echo $row['kelas']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            } else {
                echo "<p style='text-align: center; padding: 30px; color: #e74c3c;'>Data mahasiswa belum tersedia.</p>";
            }
            
            mysqli_close($koneksi);
            ?>
            
            <div style="margin-top: 30px; text-align: center;">
                <a href="tambah_mahasiswa.php" class="btn">
                    <i class="fas fa-user-plus"></i> Tambah Data Mahasiswa
                </a>
            </div>
        </div>
        
        <div class="card">
            <h2><i class="fas fa-tasks"></i> Tugas Praktikum</h2>
            <p>Buat halaman formulir untuk berbagai kebutuhan:</p>
            
            <div class="menu">
                <div class="menu-item menu-1">
                    <i class="fas fa-book menu-icon"></i>
                    <h3>Formulir Perpustakaan</h3>
                    <p>Form untuk peminjaman buku di perpustakaan "Madium"</p>
                    <a href="Formulir_Perpuskotamadium.html" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i> Buka Form
                    </a>
                </div>
                
                <div class="menu-item menu-2">
                    <i class="fas fa-motorcycle menu-icon"></i>
                    <h3>Formulir Service Motor</h3>
                    <p>Form untuk booking servis motor di bengkel terpercaya</p>
                    <a href="Formulir_Servicesmotor.html" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i> Buka Form
                    </a>
                </div>
                
                <div class="menu-item menu-3">
                    <i class="fas fa-hospital menu-icon"></i>
                    <h3>Formulir Klinik Sehat</h3>
                    <p>Form pendaftaran pasien di klinik kesehatan</p>
                    <a href="Formulir_kliniksehat.html" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i> Buka Form
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h2><i class="fas fa-info-circle"></i> Instalasi Database</h2>
            <p>Jalankan file SQL berikut untuk membuat database:</p>
            <div style="background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin: 20px 0; font-family: monospace;">
                <strong>database_mahasiswa.sql</strong><br>
                <small>Import file ini ke phpMyAdmin atau MySQL</small>
            </div>
            <a href="database_mahasiswa.sql" class="btn" download>
                <i class="fas fa-download"></i> Download File SQL
            </a>
        </div>
        
        <div class="footer">
            <p>&copy; 2025 Praktikum Pemrograman Web | Modul 11 - Database PHP</p>
            <p style="margin-top: 10px;">
                <a href="../" style="color: white; text-decoration: underline;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Modul
                </a>
            </p>
        </div>
    </div>
</body>
</html>