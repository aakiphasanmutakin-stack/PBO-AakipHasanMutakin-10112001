<?php

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

//sumber data
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

//model proses data
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
    
//logika alur program
$repo = new TagihanListrikRepository();
$data = $repo->getAll();

$hasil = [];
foreach ($data as $d) {
    $obj = new TagihanListrik();
    $obj->setData($d['nama'], $d['kwh']);

    $hasil[] = [
        'nama' => $obj->getNama(),
        'kwh' => $d["kwh"],
        'total' => $obj->HitungTotal()
    ];
}

//view output
echo "<h2>DATA TAGIHAN LISTRIK</h2>";
echo "<table border='1' cellpadding='6'>";
echo "<tr>
<th>No</th>
<th>Nama</th>
<th>pemakaian (Kwh)</th>
<th>Total Bayar</th>
</tr>";
$no= 1;

foreach ($hasil as $h) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $h['nama'] . "</td>";
    echo "<td>" . $h['kwh'] . "</td>";
    echo "<td>" . formatRupiah($h['total']) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>