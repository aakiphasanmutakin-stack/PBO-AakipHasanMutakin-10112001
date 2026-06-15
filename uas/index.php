<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}

require_once 'User.php';
$user = new User();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Inventory PBO</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="judul">
        <h1>Aplikasi Stok Gudang Barang</h1>
        <p>Halo, <b><?php echo $_SESSION['nama']; ?></b> | <a href="logout.php" style="color:red;">Logout</a></p>
    </div>

    <div class="menu">
        <div class="container">
            <ul>
                <li><a href="index.php">Home (Data User)</a></li>
                <li><a href="#">Data Master</a>
                    <ul>
                        <li><a href="#">a. Data Gudang</a></li>
                        <li><a href="#">b. Data Barang</a></li>
                        <li><a href="#">c. Data Satuan</a></li>
                        <li><a href="#">d. Data Pemasok</a></li>
                        <li><a href="#">e. Data Pelanggan</a></li>
                    </ul>
                </li>
                <li><a href="#">Data Transaksi</a>
                    <ul>
                        <li><a href="#">a. Pembelian</a></li>
                        <li><a href="#">b. Penjualan</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div style="padding: 20px; max-width: 1100px; margin: auto;">
        <h3>Manajemen Data User</h3>
        <a class="tombol" href="input.php">+ Tambah User</a>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Opsi</th>
            </tr>
            <?php 
            $no = 1;
            foreach($user->tampilData() as $data){ 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['pekerjaan']; ?></td>
                <td>
                    <a class="edit" href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> |
                    <a class="hapus" href="hapus.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>