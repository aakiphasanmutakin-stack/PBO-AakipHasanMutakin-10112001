<?php
class KalkulatorBangunRuang {
    public $dataBangun;
    public function __construct($data) {
        $this->dataBangun = $data;
    }
    public function hitungVolume($jenis, $sisi, $jari, $tinggi) {
        $pi = 3.14; 
        $volume = 0;

        switch ($jenis) {
            case 'Bola':
                $volume = (4/3) * $pi * pow($jari, 3);
                break;
            case 'Kerucut':
                $volume = (1/3) * $pi * pow($jari, 2) * $tinggi;
                break;
            case 'Limas Segi Empat':
                $volume = (1/3) * pow($sisi, 2) * $tinggi;
                break;
            case 'Kubus':
                $volume = pow($sisi, 3);
                break;
            case 'Tabung':
                $volume = $pi * pow($jari, 2) * $tinggi;
                break;
        }
        
        return $volume;
    }

    public function tampilkanTabel() {
        echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; font-family: Arial, sans-serif;'>";
        echo "<tr style='background-color: blue; color: white;'>
                <th>Jenis Bangun Ruang</th>
                <th>Sisi</th>
                <th>Jari-jari</th>
                <th>Tinggi</th>
                <th>Volume</th>
              </tr>";

        foreach ($this->dataBangun as $bangun) {
            $jenis = $bangun['jenis'];
            $sisi = $bangun['sisi'];
            $jari = $bangun['jari'];
            $tinggi = $bangun['tinggi'];

            $volume = $this->hitungVolume($jenis, $sisi, $jari, $tinggi);

            echo "<tr>
                    <td>{$jenis}</td>
                    <td align='center'>{$sisi}</td>
                    <td align='center'>{$jari}</td>
                    <td align='center'>{$tinggi}</td>
                    <td align='center'>{$volume}</td>
                  </tr>";
        }
        
        echo "</table>";
    }
}

 
$daftarBangun = [
    ['jenis' => 'Bola', 'sisi' => 0, 'jari' => 7, 'tinggi' => 0],
    ['jenis' => 'Kerucut', 'sisi' => 0, 'jari' => 14, 'tinggi' => 10],
    ['jenis' => 'Limas Segi Empat', 'sisi' => 8, 'jari' => 0, 'tinggi' => 24],
    ['jenis' => 'Kubus', 'sisi' => 30, 'jari' => 0, 'tinggi' => 0],
    ['jenis' => 'Tabung', 'sisi' => 0, 'jari' => 7, 'tinggi' => 10]
];

$kalkulator = new KalkulatorBangunRuang($daftarBangun);
$kalkulator->tampilkanTabel();

?>