<?php
class Employee {
    protected $gajiPokok;
    protected $masaKerja;

    public function __construct($gajiPokok, $masaKerja) {
        $this->gajiPokok = $gajiPokok;
        $this->masaKerja = $masaKerja;
    }

    public function hitungGaji() {
        return $this->gajiPokok;
    }
}

class Programmer extends Employee {
    public function __construct($gajiPokok, $masaKerja) {
        parent::__construct($gajiPokok, $masaKerja);
    }

    public function hitungGaji() {
        $totalGaji = parent::hitungGaji();

        if ($this->masaKerja >= 1 && $this->masaKerja <= 10) {
            $totalGaji += $this->gajiPokok * (0.01 * $this->masaKerja);
        } elseif ($this->masaKerja > 10) {
            $totalGaji += $this->gajiPokok * (0.02 * $this->masaKerja);
        }

        return $totalGaji;
    }
}


class Direktur extends Employee {
    public function __construct($gajiPokok, $masaKerja) {
        parent::__construct($gajiPokok, $masaKerja);
    }

    public function hitungGaji() {
        $totalGaji = parent::hitungGaji();

        $bonus = $this->gajiPokok * (0.5 * $this->masaKerja);
        $tunjangan = $this->gajiPokok * (0.1 * $this->masaKerja);

        return $totalGaji + $bonus + $tunjangan;
    }
}

class PegawaiMingguan extends Employee {
    private $hargaBarang;
    private $stockBarang;

    public function __construct($gajiPokok, $masaKerja, $hargaBarang, $stockBarang) {
        parent::__construct($gajiPokok, $masaKerja);
        $this->hargaBarang = $hargaBarang;
        $this->stockBarang = $stockBarang;
    }
    public function hitungGaji($totalPenjualan = 0) {
        $totalGaji = parent::hitungGaji();
        $persentaseTerjual = $totalPenjualan / $this->stockBarang;

        if ($persentaseTerjual > 0.70) {
            $totalGaji += (0.10 * $this->hargaBarang) * $totalPenjualan;
        } else {
            $totalGaji += (0.03 * $this->hargaBarang) * $totalPenjualan;
        }

        return $totalGaji;
    }
}


$p = new Programmer(5000000, 5);
echo "Gaji Programmer (5 Tahun): Rp " . number_format($p->hitungGaji(), 0, ',', '.') . "<br>";

$d = new Direktur(10000000, 3);
echo "Gaji Direktur (3 Tahun): Rp " . number_format($d->hitungGaji(), 0, ',', '.') . "<br>";
$pm = new PegawaiMingguan(2000000, 2, 50000, 100);
echo "Gaji Pegawai Mingguan (Terjual 80 barang): Rp " . number_format($pm->hitungGaji(80), 0, ',', '.') . "<br>";

?>