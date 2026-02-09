<?php
class belanja{  // ini adalah class belanja
    public string $namaPembeli = "Aakip"; //ini adalah variabel bertipe data string
    public string $namaBarang = "martabak"; //ini adalah variabel bertipe data string
    public int $hargaBarang = 180000; //ini adalah variabel bertipe data integer
    public int $jumlahBayar = 4; //ini adalah variabel bertipe data integer
    public float $totalBayar; //ini adalah variabel bertipe data float/real, jadi ada koma di bilangannya
    public float $diskon; //ini adalah variabel bertipe data float/real, jadi ada koma di bilangannya
    public static float $pajak = 0.02; //ini adalah variable tetap, gabisa di ubah

    public function __constructor($namaPembeli) //ini adalah variabel bertipe data string
    {
        $this->namaPembeli = $namaPembeli; //ini adalah variabel bertipe data string
    }

    public function tampilRincian($namaPembeli)
    {
        echo "Nama Pembeli: ".$this->namaPembeli, "<br>";
        echo "Nama Barang: ".$this->namaBarang, "<br>";
        echo "Harga Barang: ".$this->hargaBarang, "<br>";
        echo "Jumlah Bayar: ".$this->jumlahBayar, "<br>";
    }
}

$belanja1 = new belanja("Awam");
$belanja1->tampilRincian($belanja1->namaPembeli);
?>