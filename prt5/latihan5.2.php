<?php
function formatRp($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

class belanja{

public $namaPembeli;
public $namaBarang;
public $Harga;
public $jmlhBeli;

public function hitungSubtotal(){
return $this->Harga*$this->jmlhBeli;
}

public function hitungDiskon($subtotal){
    if($subtotal > 1000000){
        return $subtotal * 0.1;
    }
    return 0;
}

public function hitungTotaldgdskn(){
$subtotal=$this->hitungSubtotal();
$diskon=$this->hitungDiskon ($subtotal);
return $subtotal - $diskon;

}
}

$data = [
    [
    'namaPembeli'=> "aku",
    'namaBarang'=> "pc",
    'jumlahBeli'=> 2,
    'harga'=> 1000000
    ],
    [
    'namaPembeli'=> "zaki",
    'namaBarang'=> "hp",
    'jumlahBeli'=> 1,
    'harga'=> 200000
    ]
];
echo "<h2>TRANSAKSI 1</H2>";

$errors1=[];

$nama   =$data[0]["namaPembeli"];
$barang =$data[0]["namaBarang"];
$harga  =$data[0]["harga"];
$jumlah =$data[0]["jumlahBeli"];

if (empty($nama)){
    $errors1[]="nama pembeli tidak boleh kosong.";
}
if ($harga<=0){
    $errors1[]="harga harus lebih dari 0.";
}
if ($jumlah<=0){
    $errors1[]="jumlah beli harus lebih dari 0.";
}


if (!empty($errors1)){

    foreach ($errors1 as $error){
        echo $error .  "<br>";
    }
}else{
    $belanja1 = new belanja();
    $belanja1->namaPembeli  = $nama;
    $belanja1->namaBarang   = $barang;
    $belanja1->Harga        =$harga;
    $belanja1->jmlhBeli     = $jumlah;

    $subtotal=$belanja1->hitungSubtotal();
    $diskon  =$belanja1->hitungDiskon($subtotal);
    $total   =$belanja1->hitungTotaldgdskn();

    echo "Nama pembeli: ".$belanja1->namaPembeli."<br>";
    echo "Nama barang: ".$belanja1->namaBarang."<br>";
    echo "subtotal: ".formatRp($subtotal)."<br>";
    echo "Diskon: ".formatRp($diskon)."<br>";
    echo "<b>Total Bayar: ".formatRp($total)."</b><br><br>";

}

echo "<h2>TRANSAKSI 2</H2>";

$errors2=[];

$nama   =$data[1]["namaPembeli"];
$barang =$data[1]["namaBarang"];
$harga  =$data[1]["harga"];
$jumlah =$data[1]["jumlahBeli"];

if (empty($nama)){
    $errors2[]="nama pembeli tidak boleh kosong.";
}
if ($harga<=0){
    $errors2[]="harga harus lebih dari 0.";
}
if ($jumlah<=0){
    $errors2[]="jumlah beli harus lebih dari 0.";
}


if (!empty($errors2)){

    foreach ($errors2 as $error){
        echo $error .  "<br>";
    }
}else{
    $belanja2 = new belanja();
    $belanja2->namaPembeli  = $nama;
    $belanja2->namaBarang   = $barang;
    $belanja2->Harga        =$harga;
    $belanja2->jmlhBeli     = $jumlah;

    $subtotal=$belanja2->hitungSubtotal();
    $diskon  =$belanja2->hitungDiskon($subtotal);
    $total   =$belanja2->hitungTotaldgdskn();

    echo "Nama pembeli: ".$belanja2->namaPembeli."<br>";
    echo "Nama barang: ".$belanja2->namaBarang."<br>";
    echo "subtotal: ".formatRp($subtotal)."<br>";
    echo "Diskon: ".formatRp($diskon)."<br>";
    echo "<b>Total Bayar: ".formatRp($total)."</b><br><br>";

}



?>