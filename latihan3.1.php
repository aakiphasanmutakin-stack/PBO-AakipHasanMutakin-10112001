<?php
class kendaraan{
    public $jumlahroda=4;
    public $warna;
    public $bahanbakar="Premium";
    public $harga="10000000";
    public $merek;
    public $tahunPembuatan=2004;
  

    public function StatusHarga(){
        if($this->harga>50000000){
            $status = "Harga Kendaraan Mahal";
        }
        else{
            $status = "Harga Kendaraan Murah";
        }
        return $status;

    }
    public function statusSubsidi(){
        if($this->tahunPembuatan<2005 && $this->bahanbakar=="Premium"){
            $status = "DAPAT SUBSIDI";
        }else{
            $status = "TIDAK DAPAT SUBSIDI";
        }
        return $status; 

    }

}
$ObjekKendaraan = new kendaraan();
echo "jumlahRoda:".$ObjekKendaraan->jumlahroda."<br/>";
echo "jumlahRoda:".$ObjekKendaraan->StatusHarga()."<br/>";
echo "Status Subsidi:".$ObjekKendaraan->statusSubsidi()."<br/>";

$ObjekKendaraan1 = new kendaraan();
echo"Kendaraan 1 <br>";
$ObjekKendaraan1->harga=10000000;
$ObjekKendaraan1->tahunPembuatan= 1999;
echo "Status Harga: ".$ObjekKendaraan1->StatusHarga();
 
echo" <br>Kendaraan 2";
$ObjekKendaraan2 = new kendaraan();
$ObjekKendaraan2->bahanbakar="Pertamax";
$ObjekKendaraan2->tahunPembuatan = 1999;
echo "<br>";
echo "Status BBM: ".$ObjekKendaraan2->statusSubsidi();
echo "<br>";
echo "Harga Bekas: ". $ObjekKendaraan2 ->StatusHarga();

?>