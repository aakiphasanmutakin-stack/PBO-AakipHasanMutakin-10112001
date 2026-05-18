<?php
function formatRp($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

class belanja{

public $namaPembeli;
public $totalBelanja;
public $mmbr;

public function hitungDiskon(){
    $diskon=0;
    if($this-> mmbr=="iya"){
        if ($this->totalBelanja>500000){
            $diskon=50000;
        }elseif($this->totalBelanja>100000){
            $diskon=15000;
        }
    }else{
        if ($this->totalBelanja > 100000) {
            $diskon = 5000;

    }

    }
    return $diskon;
}

public function hitungTotal(){
    return $this->totalBelanja-$this->hitungDiskon();
}

}


$data = [
    ['member' =>"iya", 'total'=>890000],
    ['member' =>"iya", 'total'=>356000],
    ['member' =>"tidak", 'total'=>230000]

];

for ($i = 0; $i < count($data); $i++) {
    $blnj = new belanja();

    $blnj->mmbr = $data[$i]['member'];
    $blnj->totalBelanja = $data[$i]['total'];

    echo "Status Member: " . $blnj->mmbr . "<br>";
    echo "Total Belanja: " . formatRp($blnj->totalBelanja) . "<br>";
    echo "Diskon: " . formatRp($blnj->hitungDiskon()) . "<br>";
    echo "<b>Total Bayar: " . formatRp($blnj->hitungTotal()) . "</b><br>";
    echo "-----------------------------------<br>";

}

?>