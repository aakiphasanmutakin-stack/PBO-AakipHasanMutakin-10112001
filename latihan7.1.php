<?php
class produk{
    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama=$nama;
        $this->harga=$harga;
    }

    public function getInfo(){
        return "produk: $this->nama - Rp ". number_format($this->harga, 0, ',', '.');
    }
}

class ProduckDigital extends produk {
    public $ukuranFile;

    public function __construct($nama, $harga, $ukuranFile){
        parent::__construct($nama, $harga);
        $this->ukuranFile=$ukuranFile;
    }

    public function getInfo(){
        return "produk digital: $this->nama - Rp ". number_format($this->harga, 0, ',', '.')." - Size:$this->ukuranFile MB";
    }
}
$p1= new produk("Buku",500000);
$p2= new ProduckDigital("ebook php",200000,100);

echo $p1->getInfo()."<br>";
echo $p2->getInfo()."<br>";
?>