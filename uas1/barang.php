<!DOCTYPE html>
<html>
<head>
    <title>Data Barang - Inventory</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="judul">
        <h1>Aplikasi Stok Gudang Barang</h1>
        <h2>Manajemen Data Barang</h2>
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
                        <li><a href="pembelian.php">a. Pembelian</a></li>
                        <li><a href="penjualan.php">b. Penjualan</a></li>
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

    <br/>
    <a class="tombol" href="input-barang.php">+ Tambah Barang Baru</a>

    <h3>Data Master Barang</h3>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Opsi</th>
        </tr>
        <?php 
        include "koneksi.php";
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
        $nomor = 1;
        if($query_mysql){
            while($data = mysqli_fetch_array($query_mysql)){
        ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['kd_barang']; ?></td>
            <td><?php echo $data['nama_barang']; ?></td>
            <td><?php echo $data['stok']; ?></td>
            <td>
                <a class="edit" href="edit-barang.php?kd_barang=<?php echo $data['kd_barang']; ?>">Edit</a> |
                <a class="hapus" href="hapus-barang.php?kd_barang=<?php echo $data['kd_barang']; ?>">Hapus</a>
            </td>
        </tr>
        <?php 
            } 
        } else {
            echo "<tr><td colspan='5'>Tabel barang belum dibuat atau masih kosong</td></tr>";
        }
        ?>
    </table>
</body>
</html>