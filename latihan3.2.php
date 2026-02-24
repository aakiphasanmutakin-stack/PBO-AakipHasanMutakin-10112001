<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegadaian Syariah</title>
</head>
<body>
    <h1>Program Penghitung Angsuran Hutang</h1>
    <form action="" method="post">
        Besaran Pinjaman (Rp): <input type="number" name="p" required><br><br>
        Bunga (%): <input type="number" name="bnga" required><br><br>
        Lama Angsuran (Bulan): <input type="number" name="blan" required><br><br>
        Keterlambatan (Hari): <input type="number" name="tlat" required><br><br>
        <input type="submit" name="hitung" value="Hitung Angsuran">
    </form>

    <hr>

    <?php
    if (isset($_POST['hitung'])) {
        
        class Pegadaian {
            
            public $pinjaman;
            public $bungaPersen;
            public $bulan;
            public $telatHari;
            private $dendaPerHari = 0.0015;


            public function __construct($p, $b, $bln, $t) {
                $this->pinjaman = $p;
                $this->bungaPersen = $b;
                $this->bulan = $bln;
                $this->telatHari = $t;
            }

            public function hitungTotalPinjaman() {
                return $this->pinjaman + ($this->pinjaman * ($this->bungaPersen / 100));
            }

            public function hitungAngsuran() {
                return $this->hitungTotalPinjaman() / $this->bulan;
            }

            public function hitungDenda() {
                return $this->hitungAngsuran() * $this->dendaPerHari * $this->telatHari;
            }

            public function hitungTotalPembayaran() {
                return $this->hitungAngsuran() + $this->hitungDenda();
            }
        }

    
        $hitungHutang = new Pegadaian($_POST['p'], $_POST['bnga'], $_POST['blan'], $_POST['tlat']);

        echo "<h3>Hasil Perhitungan:</h3>";
        echo "Total Pinjaman: Rp. " . number_format($hitungHutang->hitungTotalPinjaman(), 0, ',', '.') . "<br>";
        echo "Besaran Angsuran: Rp. " . number_format($hitungHutang->hitungAngsuran(), 0, ',', '.') . "<br>";
        echo "Denda Keterlambatan ($hitungHutang->telatHari Hari): Rp. " . number_format($hitungHutang->hitungDenda(), 0, ',', '.') . "<br>";
        echo "<strong>Total Pembayaran: Rp. " . number_format($hitungHutang->hitungTotalPembayaran(), 0, ',', '.') . "</strong>";

        //itu number format saya cari di internet, biar formatnya ga (10000), tapi jadi ada titik atau koma kalau desimal, terus strong biar menunjukan kalo itu penting, jadi dia bold sendiri
        
    }
    ?>
</body>
</html>


