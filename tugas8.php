<?php

class Karyawan {
    public $nama;
    public $golongan;
    public $jamLembur;

    // 5. Tambahkan constructor dengan parameter
    public function __construct($nama, $golongan, $jamLembur) {
        $this->nama = $nama;
        $this->golongan = $golongan;
        $this->jamLembur = $jamLembur;
    }

    // 1. Method getGajiPokok dengan ketentuan besaran gaji
    public function getGajiPokok() {
        // Menggunakan array untuk mapping golongan dan gaji biar lebih rapi dari switch-case
        $daftarGaji = [
            "Ib" => 1250000, "Ic" => 1300000, "Id" => 1350000,
            "IIa" => 2000000, "IIb" => 2100000, "IIc" => 2200000, "IId" => 2300000,
            "IIIa" => 2400000, "IIIb" => 2500000, "IIIc" => 2600000, "IIId" => 2700000,
            "IVa" => 2800000, "IVb" => 2900000, "IVc" => 3000000, "IVd" => 3100000
        ];
        
        // Percabangan untuk ngecek apakah golongan ada di daftar
        if (array_key_exists($this->golongan, $daftarGaji)) {
            return $daftarGaji[$this->golongan];
        } else {
            return 0; // Default jika golongan tidak valid
        }
    }

    // Method tambahan untuk hitung total gaji
    public function getTotalGaji() {
        // 2. Besaran lembur tiap jam adalah Rp 15000
        $uangLembur = $this->jamLembur * 15000;
        return $this->getGajiPokok() + $uangLembur;
    }

    // 7. Function destruct berfungsi untuk meng-unset objek
    public function __destruct() {
        // Method ini otomatis terpanggil saat memori objek dibersihkan (pakai perintah unset() nanti di menu Hapus)
        // Kita biarkan kosong/silent agar terminal tetap rapi seperti di contoh gambar.
    }
}

// 4. Gunakan array untuk menampung objek (CRUD)
$karyawanList = [];

// Data Awal (biar outputnya langsung mirip sama gambar studi kasus)
$karyawanList[] = new Karyawan("Winny", "IIb", 30);
$karyawanList[] = new Karyawan("Stendy", "IIIc", 32);
$karyawanList[] = new Karyawan("Alfred", "IVb", 30);

// 3. Gunakan perulangan (do-while) dan percabangan (switch-case)
do {
    echo "\n===== MENU GAJI KARYAWAN =====\n";
    echo "1. Tampilkan Data\n";
    echo "2. Tambah Data\n";
    echo "3. Update Data\n";
    echo "4. Hapus Data\n";
    echo "5. Keluar\n";
    echo "Pilih menu: ";
    
    $menu = trim(fgets(STDIN));

    switch ($menu) {
        case 1: // READ
            echo "\n===== DATA GAJI KARYAWAN =====\n";
            echo "No | Nama | Golongan | Jam Lembur | Total Gaji\n";
            
            $no = 1;
            foreach ($karyawanList as $karyawan) {
                // Format angka biar ada koma pemisah ribuan
                $totalGajiFormat = "Rp" . number_format($karyawan->getTotalGaji(), 0, ',', ',');
                echo $no . " | " . $karyawan->nama . " | " . $karyawan->golongan . " | " . $karyawan->jamLembur . " | " . $totalGajiFormat . "\n";
                $no++;
            }
            break;

        case 2: // CREATE
            echo "Masukkan Nama: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan Golongan (contoh: IIb): ";
            $golongan = trim(fgets(STDIN));
            echo "Masukkan Jam Lembur: ";
            $lembur = (int)trim(fgets(STDIN));
            
            $karyawanList[] = new Karyawan($nama, $golongan, $lembur);
            echo "Data Karyawan berhasil ditambahkan!\n";
            break;

        case 3: // UPDATE
            echo "Masukkan Nomor (No) data yang ingin diupdate: ";
            $noUpdate = (int)trim(fgets(STDIN));
            $indexUpdate = $noUpdate - 1;

            // Kita re-index array dulu jaga-jaga kalau ada data yang udah dihapus sebelumnya
            $karyawanList = array_values($karyawanList);

            if (isset($karyawanList[$indexUpdate])) {
                echo "Nama Baru (kosongkan jika tidak ingin ganti): ";
                $namaBaru = trim(fgets(STDIN));
                if ($namaBaru != "") $karyawanList[$indexUpdate]->nama = $namaBaru;

                echo "Golongan Baru (kosongkan jika tidak ingin ganti): ";
                $golBaru = trim(fgets(STDIN));
                if ($golBaru != "") $karyawanList[$indexUpdate]->golongan = $golBaru;

                echo "Jam Lembur Baru (kosongkan jika tidak ingin ganti): ";
                $lemburBaru = trim(fgets(STDIN));
                if ($lemburBaru != "") $karyawanList[$indexUpdate]->jamLembur = (int)$lemburBaru;

                echo "Data Karyawan berhasil diupdate!\n";
            } else {
                echo "Data tidak ditemukan.\n";
            }
            break;

        case 4: // DELETE
            echo "Masukkan Nomor (No) data yang ingin dihapus: ";
            $noHapus = (int)trim(fgets(STDIN));
            $indexHapus = $noHapus - 1;

            $karyawanList = array_values($karyawanList); // Re-index biar nyocokin nomornya pas

            if (isset($karyawanList[$indexHapus])) {
                // Di sini perintah unset() dijalankan, yang otomatis akan memanggil method __destruct() di dalam class
                unset($karyawanList[$indexHapus]);
                
                // Susun ulang index array setelah ada yang dihapus
                $karyawanList = array_values($karyawanList); 
                echo "Data Karyawan berhasil dihapus dan memori di-unset!\n";
            } else {
                echo "Data tidak ditemukan.\n";
            }
            break;

        case 5:
            echo "Program selesai. Keluar...\n";
            break;

        default:
            echo "Menu yang dipilih tidak valid.\n";
            break;
    }

} while ($menu != 5);

?>