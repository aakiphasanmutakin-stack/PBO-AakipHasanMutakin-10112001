<?php
class TagihanListrik{
    private $nama;
    private $kwh;
    private $tarif = 1500; //per kwh
    
    public function setData($nama, $kwh) {
        $this->nama = $nama;
        $this->kwh = $kwh;
    }
    
    public function getNama() {
        return $this->nama;
    }
    public function HitungTotal() {
        $total = $this->kwh * $this->tarif;

        //diskon
        if ($this->kwh > 1000) {
            $total = $total - 50000;
        }
        
        return $total;
    }

}
?>