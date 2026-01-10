<?php
// index.php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP & MySQL - Modul 12</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="judul">
            <h1>Membuat Koneksi Dengan PHP Dan MySQL</h1>
            <h2>Menampilkan data dari database</h2>
            <h3>www.unipma.ac.id</h3>
        </div>
        
        <div class="pesan">
            <?php
            if(isset($_GET['pesan'])){
                $pesan = $_GET['pesan'];
                $class = '';
                $icon = '';
                
                if($pesan == "input"){
                    echo '<div class="success"><i class="fas fa-check-circle"></i> Data berhasil di input.</div>';
                } else if($pesan == "update"){
                    echo '<div class="success"><i class="fas fa-sync-alt"></i> Data berhasil di update.</div>';
                } else if($pesan == "hapus"){
                    echo '<div class="success"><i class="fas fa-trash-alt"></i> Data berhasil di hapus.</div>';
                } else if($pesan == "error"){
                    echo '<div class="error"><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan!</div>';
                }
            }
            ?>
        </div>
        
        <a class="tombol" href="input.php">
            <i class="fas fa-plus"></i> + Tambah Data Baru
        </a>
        
        <div class="table-container">
            <h3 class="data-user"><i class="fas fa-users"></i> Data Mahasiswa</h3>
            
            <table border="1" class="table">
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th>Opsi</th>
                </tr>
                
                <?php
                $query_mysql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY kelas, nama") or die(mysqli_error($koneksi));
                $no = 1;
                
                while($data = mysqli_fetch_array($query_mysql)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['npm']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td>
                        <div class="aksi">
                            <a class="tombol edit" href="edit.php?npm=<?php echo $data['npm']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a class="tombol hapus" href="hapus.php?npm=<?php echo $data['npm']; ?>" 
                               onclick="return confirm('Yakin ingin menghapus data <?php echo $data['nama']; ?>?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
            <?php 
            if(mysqli_num_rows($query_mysql) == 0) {
                echo '<div class="pesan info"><i class="fas fa-info-circle"></i> Belum ada data mahasiswa.</div>';
            }
            ?>
        </div>
        
        <div class="footer">
            <p>Modul 12: CRUD PHP & MySQL | Praktikum Pemrograman Web</p>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($koneksi); ?>