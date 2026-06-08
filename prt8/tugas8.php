<?php

class Karyawan {
    public $nama;
    public $golongan;
    public $jamLembur;

    
    public function __construct($nama, $golongan, $jamLembur) {
        $this->nama = $nama;
        $this->golongan = $golongan;
        $this->jamLembur = $jamLembur;
    }

    
    public function getGajiPokok() {
        $daftarGaji = [
            "Ib" => 1250000, "Ic" => 1300000, "Id" => 1350000,
            "IIa" => 2000000, "IIb" => 2100000, "IIc" => 2200000, "IId" => 2300000,
            "IIIa" => 2400000, "IIIb" => 2500000, "IIIc" => 2600000, "IIId" => 2700000,
            "IVa" => 2800000, "IVb" => 2900000, "IVc" => 3000000, "IVd" => 3100000
        ];
        
        
        if (array_key_exists($this->golongan, $daftarGaji)) {
            return $daftarGaji[$this->golongan];
        } else {
            return 0;
        }
    }

    
    public function getTotalGaji() {
        
        $uangLembur = $this->jamLembur * 15000;
        return $this->getGajiPokok() + $uangLembur;
    }

    
    public function __destruct() {
        
    }
}


$karyawanList = [];


$karyawanList[] = new Karyawan("Winny", "IIb", 30);
$karyawanList[] = new Karyawan("Stendy", "IIIc", 32);
$karyawanList[] = new Karyawan("Alfred", "IVb", 30);


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

        case 4: 
            echo "Masukkan Nomor (No) data yang ingin dihapus: ";
            $noHapus = (int)trim(fgets(STDIN));
            $indexHapus = $noHapus - 1;

            $karyawanList = array_values($karyawanList);

            if (isset($karyawanList[$indexHapus])) {
                
                unset($karyawanList[$indexHapus]);
                
                
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