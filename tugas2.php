<?php
class KalkulatorSuhu {
    private $celsius;

    public function __construct($celsius) {
        $this->celsius = $celsius;
    }

    public function keFahrenheit() {
        return ($this->celsius * 9/5) + 32;
    }

    public function keKelvin() {
        return $this->celsius + 273.15;
    }

    public function getCelsius() {
        return $this->celsius;
    }
}

// Contoh penggunaan
$suhu = new KalkulatorSuhu(25);

echo "Suhu dalam Celsius: " . $suhu->getCelsius() . "°C<br>";
echo "Suhu dalam Fahrenheit: " . $suhu->keFahrenheit() . "°F<br>";
echo "Suhu dalam Kelvin: " . $suhu->keKelvin() . " K";

?>
