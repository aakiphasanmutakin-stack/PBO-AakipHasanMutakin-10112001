<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegadaian</title>
</head>
<body>
    <h1> pinjaman <h1>
    <form action="" method="post">
        Besaran Pinjaman:
        <input type="number" name="pnjm"><br>
        Bunga %: 
        <input type="number" name="bnga"><br>
        Lama Angsuran:
        <input type="number" name="bln"><br>
        Keterlambatan Angsuran:
        <input type="number" name="lmbt"><br>
        <input type="submit" value="Simpan">
    </form>
<?php
class angsuran{
    $pinjam = $_POST['pnjm'];
    $bunga = $_POST['bnga'];
    $bulan = $_POST['bln'];
    $lambat = $_POST['lmbt'];
    if()

}
?>

</body>
</html>

































        php
<?php
class HitungAngsuran {
    // Property untuk menyimpan data
    public $pinjam;
    public $bunga;
    public $bulan;
    public $lambat;

    // Constructor untuk mengisi data saat objek dibuat
    public function __construct($p, $bg, $bln, $l) {
        $this->pinjam = $p;
        $this->bunga = $bg;
        $this->bulan = $bln;
        $this->lambat = $l;
    }

    // Method untuk menghitung total pinjaman
    public function totalPinjaman() {
        return $this->pinjam + ($this->pinjam * ($this->bunga / 100));
    }

    // Method untuk menghitung angsuran pokok per bulan
    public function angsuranPerBulan() {
        return $this->totalPinjaman() / $this->bulan;
    }

    // Method untuk menghitung denda (0.15% per hari dari angsuran)
    public function hitungDenda() {
        return $this->angsuranPerBulan() * 0.0015 * $this->lambat;
    }

    // Method untuk total pembayaran akhir
    public function totalBayar() {
        return $this->angsuranPerBulan() + $this->hitungDenda();
    }
}

// Logika saat tombol simpan ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Membuat objek baru dari class angsuran
    $proses = new HitungAngsuran($_POST['pnjm'], $_POST['bnga'], $_POST['bln'], $_POST['lmbt']);

    echo "<h3>Hasil Perhitungan:</h3>";
    echo "Total Pinjaman: Rp. " . number_format($proses->totalPinjaman(), 0, ',', '.') . "<br>";
    echo "Besaran Angsuran: Rp. " . number_format($proses->angsuranPerBulan(), 0, ',', '.') . "<br>";
    echo "Denda Keterlambatan: Rp. " . number_format($proses->hitungDenda(), 0, ',', '.') . "<br>";
    echo "<strong>Besaran Pembayaran: Rp. " . number_format($proses->totalBayar(), 0, ',', '.') . "</strong>";
}
?>

