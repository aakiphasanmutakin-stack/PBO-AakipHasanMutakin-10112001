<?php
require_once 'Database.php';

class Transaksi extends Database {
    
    // Transaksi Pembelian (Stock In)
    public function pembelian($idBarang, $idPemasok, $qty, $nota) {
        $tgl = date('Y-m-d');
        // Catat riwayat
        mysqli_query($this->conn, "INSERT INTO pembelian (nota, tgl, id_pemasok, id_barang, qty) VALUES ('$nota', '$tgl', '$idPemasok', '$idBarang', '$qty')");
        // Update Stok Master (Otomatis Bertambah)
        mysqli_query($this->conn, "UPDATE barang SET stok = stok + $qty WHERE id_barang = '$idBarang'");
        return true;
    }

    // Transaksi Penjualan (Stock Out)
    public function penjualan($idBarang, $idPelanggan, $qty, $nota) {
        // Validasi: Cek apakah stok cukup
        $cek = mysqli_query($this->conn, "SELECT stok FROM barang WHERE id_barang = '$idBarang'");
        $data = mysqli_fetch_assoc($cek);
        
        if($data['stok'] >= $qty) {
            $tgl = date('Y-m-d');
            // Catat riwayat
            mysqli_query($this->conn, "INSERT INTO penjualan (nota, tgl, id_pelanggan, id_barang, qty) VALUES ('$nota', '$tgl', '$idPelanggan', '$idBarang', '$qty')");
            // Update Stok Master (Otomatis Berkurang)
            mysqli_query($this->conn, "UPDATE barang SET stok = stok - $qty WHERE id_barang = '$idBarang'");
            return "Transaksi Berhasil!";
        } else {
            return "Gagal: Stok barang tidak mencukupi!";
        }
    }
}
?>