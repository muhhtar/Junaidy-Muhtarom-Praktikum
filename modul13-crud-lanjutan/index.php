<?php
// index.php - Modul 13
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Lengkap - Update & Delete Data</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container fade-in">
        <div class="judul">
            <h1><i class="fas fa-database"></i> Membuat Koneksi Dengan PHP Dan MySQL</h1>
            <h2>Update dan Delete data di database dengan PHP</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <?php tampilkanPesan(); ?>
        
        <a class="tombol tambah" href="input.php">
            <i class="fas fa-plus-circle"></i> + Tambah Data Baru
        </a>
        
        <div class="table-container">
            <h3 class="data-user">
                <i class="fas fa-users"></i> Data Mahasiswa
                <span style="font-size: 1rem; color: #6c757d; margin-left: auto;">
                    <?php
                    $total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM mahasiswa");
                    $row = mysqli_fetch_assoc($total);
                    echo "Total: " . $row['total'] . " data";
                    ?>
                </span>
            </h3>
            
            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, 
                        "SELECT *, 
                        CASE 
                            WHEN kelas LIKE '%A%' THEN 'badge-a'
                            WHEN kelas LIKE '%B%' THEN 'badge-b' 
                            WHEN kelas LIKE '%C%' THEN 'badge-c'
                            ELSE 'badge-9'
                        END as badge_class
                        FROM mahasiswa 
                        ORDER BY kelas, nama") 
                        or die(mysqli_error($koneksi));
                    
                    $no = 1;
                    
                    if(mysqli_num_rows($query) > 0) {
                        while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo $data['npm']; ?></strong></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td>
                            <span class="badge <?php echo $data['badge_class']; ?>">
                                <?php echo $data['kelas']; ?>
                            </span>
                        </td>
                        <td>
                            <div class="aksi">
                                <a class="tombol edit" href="edit.php?npm=<?php echo $data['npm']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="tombol hapus" href="hapus.php?npm=<?php echo $data['npm']; ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data <?php echo addslashes($data['nama']); ?>?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #6c757d;">
                            <i class="fas fa-database" style="font-size: 3rem; color: #dee2e6; margin-bottom: 15px; display: block;"></i>
                            <h3>Belum Ada Data</h3>
                            <p>Silakan tambahkan data mahasiswa terlebih dahulu</p>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p><strong>Modul 13:</strong> Update dan Delete data di database dengan PHP | Praktikum Pemrograman Web</p>
            <p style="margin-top: 10px; font-size: 0.9rem;">
                Fitur: Create, Read, Update, Delete (CRUD Lengkap)
            </p>
        </div>
    </div>
    
    <script>
        // Animasi untuk hover table row
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.table tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transition = 'transform 0.2s, background 0.3s';
                });
            });
        });
    </script>
</body>
</html>
<?php mysqli_close($koneksi); ?>