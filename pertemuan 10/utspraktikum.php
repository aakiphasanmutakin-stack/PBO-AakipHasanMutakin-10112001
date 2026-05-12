<?php
class Produk {
    public $nama;
    public $harga;
    public $stok;
    
    public function __construct($nama, $harga, $stok) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }
    public function __destruct(){

    }
    public function nmbhDta(){
        $this->produklist[] = new Produk($this->nama, $this->harga, $this->stok);
    }
    
}

$produklist = [];
$produklist[] = new Produk("Buku", 10000, 10);
$produklist[] = new Produk("Pensil", 5000, 20);
$produklist[] = new Produk("Penghapus", 2000, 5);

do {
    echo "\n===== MENU TOKO =====\n";
    echo "1. Tampilkan Data Produk\n";
    echo "2. Tambah Produk\n";
    echo "3. Update Produk\n";
    echo "4. Hapus Produk\n";
    echo "5. Keluar\n";
    echo "Pilih menu: ";
    
    $menu = trim(fgets(STDIN));

    switch ($menu) {
        case 1://read
            echo "\n===== DATA PRODUK =====\n";
            echo "No | Nama | Harga | Stok\n";
            
            $no = 1;
            foreach ($produklist as $produk) {
                echo $no . " | " . $produk->nama . " | " . $produk->harga . " | " . $produk->stok . "\n";
                $no++;
            }
            break;
        case 2://tambah
            echo "Masukkan Nama Produk: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan Harga: ";
            $harga = (int)trim(fgets(STDIN));
            echo "Masukkan Stok: ";
            $stok = (int)trim(fgets(STDIN));
            $produk = new Produk($nama, $harga, $stok);
            $produk->nmbhDta();
            echo "Data Produk berhasil ditambahkan!\n";
            break;
        case 3: // UPDATE
            echo "Masukkan Nomor (No) data yang ingin diupdate: ";
            $noUpdate = (int)trim(fgets(STDIN));
            $indexUpdate = $noUpdate - 1;
            $produklist = array_values($produklist);

            if (isset($produklist[$indexUpdate])) {
                echo "Nama Baru (kosongkan jika tidak ingin ganti): ";
                $namaBaru = trim(fgets(STDIN));
                if ($namaBaru != "") $produklist[$indexUpdate]->nama = $namaBaru;

                echo "Harga Baru (kosongkan jika tidak ingin ganti): ";
                $hargaBaru = trim(fgets(STDIN));
                if ($hargaBaru != "") $produklist[$indexUpdate]->harga = (int)$hargaBaru;

                echo "Stok Baru (kosongkan jika tidak ingin ganti): ";
                $stokBaru = trim(fgets(STDIN));
                if ($stokBaru != "") $produklist[$indexUpdate]->stok = (int)$stokBaru;

                echo "Data Produk berhasil diupdate!\n";
            } else {
                echo "Data tidak ditemukan.\n";
            }
            break;

        case 4: // DELETE
            echo "Masukkan Nomor (No) data yang ingin dihapus: ";
            $noHapus = (int)trim(fgets(STDIN));
            $indexHapus = $noHapus - 1;

            $produklist = array_values($produklist);

            if (isset($produklist[$indexHapus])) {
                unset($produklist[$indexHapus]);
                $produklist = array_values($produklist); 
                echo "Data Produk berhasil dihapus dan memori di-unset!\n";
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