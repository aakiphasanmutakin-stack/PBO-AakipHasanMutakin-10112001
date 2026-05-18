<?php
function formatRp($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

class belanja{

public $namaPembeli;
public $namaBarang;
public $Harga;
public $jmlhBeli;
public  $member;

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
    'harga'=> 1000000,
    'Member'=>true
    ],
    [
    'namaPembeli'=> "zaki",
    'namaBarang'=> "hp",
    'jumlahBeli'=> 1,
    'harga'=> 2000000,
    'Member'=>false
    ],
     [
    'namaPembeli'=> "awip",
    'namaBarang'=> "Proyektor",
    'jumlahBeli'=> 3,
    'harga'=> 2500000,
    'Member'=>true
    ]
];

echo "<table border='1' cellpadding='6'>";

echo "<tr>
<th>No</th>
<th>Nama</th>
<th>Member</th>
<th>Barang</th>
<th>Subtotal</th>
<th>Diskon</th>
<th>Total</th>
</th>";

$no = 1;

foreach($data as $d){
    
    $namaPembeli  = $d ["namaPembeli"];
    $namaBarang   = $d ["namaBarang"];
    $Harga        =$d ["harga"];
    $jmlhBeli     = $d ["jumlahBeli"];
    $member       =$d ["Member"];

    $belanja1 = new belanja();
    $belanja1->namaPembeli  = $namaPembeli;
    $belanja1->namaBarang   = $namaBarang;
    $belanja1->Harga        =$Harga;
    $belanja1->jmlhBeli     = $jmlhBeli;
    $belanja1->member       =$member;

    $subtotal=$belanja1->hitungSubtotal();
    $diskon  =$belanja1->hitungDiskon($subtotal);
    $total   =$belanja1->hitungTotaldgdskn();

    echo "<tr>";
    
    echo "<td>".$no."</td>";
    echo "<td>".$belanja1->namaPembeli."</td>";
    echo "<td>".($belanja1->member ? "Ya":"Tidak")."</td>";
    echo "<td>".$belanja1->namaBarang."</td>";
    echo "<td>".formatRp($subtotal)."</td>";
    echo "<td>".formatRp($diskon)."</td>";
    echo "<td>".formatRp($total)."</td>";

    echo "</tr>";
    $no++;

}

echo "</table>"; 

?>