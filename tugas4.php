<?php
class hasil {
public $nama;
public $kelas;
public $matkul;
public $nilai;

public function status() {

if ($this->nilai >= 60) {
return "Lulus Kuis";
} else {
return "Tidak Lulus Kuis";
}
}
}


$data = [
'nama' => ["Aditya", "Shinta", "Ineu"],
'kelas' => "SI 2",
'matkul' => "Pemrograman Berorientasi Objek",
'nilai' => [80, 75, 55]
];

for ($i = 0; $i < count($data['nama']); $i++) {
$hsl = new hasil();


$hsl->nama = $data["nama"][$i];
$hsl->kelas = $data["kelas"]; 
$hsl->matkul = $data["matkul"];
$hsl->nilai = $data["nilai"][$i];



echo "Nama: " . $hsl->nama . "<br>";
echo "Kelas: " . $hsl->kelas . "<br>";
echo "Mata Kuliah: " . $hsl->matkul . "<br>";
echo "Nilai: " . $hsl->nilai . "<br>";
echo "Status: " . $hsl->status() . "<br>";
echo "--------------------------------------------------<br>"; 
}
?>
