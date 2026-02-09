<?php
class belanja{                                  // ini adalah class belanja
    public string $namaPembeli = "Aakip";       //ini adalah variabel bertipe data string
    public string $namaBarang = "martabak";     //ini adalah variabel bertipe data string
    public int $hargaBarang = 180000;           //ini adalah variabel bertipe data integer
    public int $jumlahBayar = 4;                //ini adalah variabel bertipe data integer
    public float $totalBayar = 1;               //ini adalah variabel bertipe data float/real, jadi ada koma di bilangannya
    public float $diskon = 0.5;                 //ini adalah variabel bertipe data float/real, jadi ada koma di bilangannya
    public static float $pajak = 0.02;          //ini adalah variable tetap, gabisa di ubah

    public function __constructor($namaPembeli) //ini method dengan parameter nama pembeli
    {
        $this->namaPembeli = $namaPembeli;      //this itu buat local variable, jadi variable dalam variable
    }
    public function hitungTotal(): float
    {
        $subtotal = $this->hargaBarang * $this->jumlahBayar; //operasi aritmatika *

        return $subtotal;
    }
     public function hitungDiskon(): float
    {
        $TotalD = $this->hargaBarang * $this->diskon; //operasi aritmatika * diskon

        return $TotalD;
    }

    public function hitungTotalBayar(): float
    {
        $Total = $this->hitungTotal() - $this->hitungDiskon(); //operasi aritmatika * diskon

        return $Total;
    }

    public function tampilRincian($namaPembeli) //metod dengan local variable
    {
        echo "Nama Pembeli: ".$this->namaPembeli, "<br>";   //menampilkan hasil nama pembeli
        echo "Nama Barang: ".$this->namaBarang, "<br>";     //menampilkan hasil nama barang
        echo "Harga Barang: ".$this->hargaBarang, "<br>";   //menampilkan hasil harga barang
        echo "Jumlah Bayar: ".$this->jumlahBayar, "<br>";   //menampilkan hasil jumlah bayar
        echo "Total Bayar: ".$this->hitungTotal(), "<br>";  //Menampilkan Hasil total bayar
        echo "Total diskon: ".$this->hitungDiskon(), "<br>";//Menampilkan diskon
        echo "Total Setelah diskon: ".$this->hitungTotalBayar(), "<br>";

    }
}

$belanja1 = new belanja("Awam");
$belanja1->tampilRincian($belanja1->namaPembeli);
?>