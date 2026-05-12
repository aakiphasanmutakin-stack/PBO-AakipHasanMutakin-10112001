<?php
class TagihanListrikRepository {
    private $data = [
        ['nama' => 'Budi', 'kwh' => 1200],
        ['nama' => 'Sinta', 'kwh' => 800],
        ['nama' => 'Rani', 'kwh' => 1500],
    ];
    
    public function getAll() {
        return $this->data;
    }
}
?>