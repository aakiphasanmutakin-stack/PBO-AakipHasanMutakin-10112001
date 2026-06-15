<!DOCTYPE html>
<html>
<head>
    <title>Membuat CRUD Dengan PHP Dan MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="judul">
        <h1>Membuat CRUD Dengan PHP Dan MySQL</h1>
        <h2>Menampilkan data dari database</h2>
    </div>

   <div class="menu">
        <div class="container">
            <ul>
                <li><a href="index.php">Home (Data User)</a></li>
                
                <li><a href="#">Data Master</a>
                    <ul>
                        <li><a href="gudang.php">a. Data Gudang</a></li>
                        <li><a href="barang.php">b. Data Barang</a></li>
                        <li><a href="satuan.php">c. Data Satuan</a></li>
                        <li><a href="pemasok.php">d. Data Pemasok</a></li>
                        <li><a href="pelanggan.php">e. Data Pelanggan</a></li>
                    </ul>
                </li>

                <li><a href="#">Data Transaksi</a>
                    <ul>
                        <li><a href="pembelian.php">a. Pembelian (Stok Masuk)</a></li>
                        <li><a href="penjualan.php">b. Penjualan (Stok Keluar)</a></li>
                    </ul>
                </li>

                <li><a href="#">Laporan</a>
                    <ul>
                        <li><a href="laporan.php">a. Laporan Penjualan</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        
        <?php 
        if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
            if($pesan == "input"){
                echo "<p style='color: green;'>Data berhasil di input.</p>";
            }else if($pesan == "update"){
                echo "<p style='color: green;'>Data berhasil di update.</p>";
            }else if($pesan == "hapus"){
                echo "<p style='color: red;'>Data berhasil di hapus.</p>";
            }
        }
        ?>
        
        <a class="tombol" href="input.php">+ Tambah Data Baru</a>

        <h3>Data User</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Opsi</th>
            </tr>
            <?php 
            include "koneksi.php";
            $query_mysql = mysqli_query($koneksi, "SELECT * FROM user");
            $nomor = 1;
            while($data = mysqli_fetch_array($query_mysql)){
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['pekerjaan']; ?></td>
                <td>
                    <a class="edit" href="edit.php?id_user=<?php echo $data['id_user']; ?>">Edit</a> |
                    <a class="hapus" href="hapus.php?id_user=<?php echo $data['id_user']; ?>">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>