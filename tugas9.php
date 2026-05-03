<?php
function buatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
class UangTabungan {
    private $saldo;
    protected $namaSiswa;

    public function __construct($nama, $saldoAwal) {
        $this->namaSiswa = $nama;
        $this->saldo = $saldoAwal;
    }

    public function setor($jumlah) {
        $this->saldo += $jumlah;
    }

    public function tarik($jumlah) {
        if ($jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            return true;
        }
        return false;
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

class Siswa extends UangTabungan {
    public function getNama() {
        return $this->namaSiswa;
    }
}


$daftarSiswa = [
    new Siswa("Siswa 1", 50000),
    new Siswa("Siswa 2", 100000),
    new Siswa("Siswa 3", 75000)
];


$handle = fopen("php://stdin", "r");

while (true) {
    echo "\n=== SISTEM TABUNGAN SEKOLAH ===\n";
    foreach ($daftarSiswa as $index => $s) {
        echo "[$index] " . $s->getNama() . " - Saldo: " . buatRupiah($s->getSaldo()) . "\n";
    }
    echo "[x] Keluar\n";
    echo "Pilih nomor siswa: ";
    
    $pilihan = trim(fgets($handle));

    if ($pilihan == 'x') break;

    
    if (isset($daftarSiswa[$pilihan])) {
        $siswaTerpilih = $daftarSiswa[$pilihan];
        
        echo "\nMenu untuk " . $siswaTerpilih->getNama() . ":\n";
        echo "1. Setor Tunai\n";
        echo "2. Tarik Tunai\n";
        echo "Pilih aksi: ";
        $aksi = trim(fgets($handle));

        echo "Masukkan nominal: ";
        $nominal = (int)trim(fgets($handle));

        if ($aksi == '1') {
            $siswaTerpilih->setor($nominal);
            echo "--- Berhasil! Saldo " . $siswaTerpilih->getNama() . " bertambah ---\n";
        } elseif ($aksi == '2') {
            if ($siswaTerpilih->tarik($nominal)) {
                echo "--- Berhasil! Saldo " . $siswaTerpilih->getNama() . " berkurang ---\n";
            } else {
                echo "--- Gagal! Saldo tidak cukup ---\n";
            }
        }
    } else {
        echo "--- Nomor siswa salah! ---\n";
    }
}

fclose($handle);
echo "Program Selesai. Sampai jumpa!";
?>