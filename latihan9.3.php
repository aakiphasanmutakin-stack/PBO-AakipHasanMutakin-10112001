<?php 
class manusia{
    protected $nama="Ardi";
    var $kelas="SI 2";
    //method protected
    protected function nama(){
        return "Nama: " .$this->nama;
    }

    function tampilkan_nama(){
        return $this->nama();
    }

    protected function tampilkan_kelas(){
        return $this->kelas;
    }
}
$manusia = new manusia();
//memanggil method public
echo $manusia->tampilkan_nama()."<br />";
echo $manusia->tampilkan_kelas();

?>