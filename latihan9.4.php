<?php
class komputer {
    private $jenis_procesor = "Intel Core i7-4790 3.6Ghz";
    protected $jenis_RAM = "DDR 4";
    public $jenia_VGA = "PCI Express";

    public function tampilkan_procesor() {
        return $this->jenis_procesor;
    }
    public function tampilkan_jenisprocesor() {
        return $this->jenis_procesor;
    }
    
    private function tampilkan_ram() {
        return $this->jenis_RAM;
    }
    
    protected function tampilkan_vga() {
        return $this->jenia_VGA;
    }
    public function tampilkan_vga2() {
        return $this->jenia_VGA;
    }
}

class laptop extends komputer {
    public function display_processor() {
        return $this->jenis_procesor;
    }
    
    public function display_processor2() {
        return $this->tampilkan_procesor();
    }

    public function display_ram() {
        return $this->jenis_RAM;
    }
    
    public function display_ram2() {
        return $this->tampilkan_ram();
    }

    public function display_vga() {
        return $this->jenia_VGA;
    }
    
    public function display_vga2() {
        return $this->tampilkan_vga();
    }

    private function display_processorkomputer() {
        return $this->jenis_procesor;
    }
}
$komputer = new komputer();
$laptop = new laptop();

echo "Line 61: " . $komputer->tampilkan_procesor(). "<br />";
echo "Line 62: " . $laptop->display_processor(). "<br />";
echo "Line 63: " . $laptop->display_processor2(). "<br />";
echo "Line 64: " . $laptop->tampilkan_jenisprocesor(). "<br />";
echo "Line 65: " . $laptop->display_ram(). "<br />";
echo "Line 66: " . $laptop->display_vga(). "<br />";
echo "Line 67: " . $laptop->display_processorkomputer(). "<br />";
?>

