<?php
function formatRp($angka) {
return"Rp".number_format($angka. 0);


}
class belanja{

public $namaPembeli;
public $namaBarang;
public $Harga;
public $jmlhBeli;
public function hitungSubtotal(){
return $this->Harga*$this->jmlhBeli;

}
public function hitungTotaldgdskn($persenDiskon){
$subtotal=$this->hitungSubtotal();
$diskon=($persenDiskon/100) * $subtotal;

}
}

$data = [
'namaPembeli'=> "aku",
'namaBarang'=> "pc",
'jumlahBeli'=> "2",
'harga'=> "1000000"
];


$belanja = new belanja();
$belanja->namaPembeli = $data ["namaPembeli"];
$belanja->namaBarang = $data ["namaBarang"];
$belanja->Harga = $data ["harga"];
$belanja->jmlhBeli = $data ["jumlahBeli"];

echo "

stuck toko";
echo "Nama pembeli: ".$belanja->namaPembeli."
";
echo "Nama barang: ".$belanja->namaBarang."
";
echo "subtotal: ".formatRp($belanja->hitungSubtotal())."
";
echo "Total Diskon 10%: ".formatRp($belanja->hitungTotaldgdskn(10))."
";

?>