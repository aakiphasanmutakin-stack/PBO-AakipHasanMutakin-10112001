<?php

try {
$host = "localhost";
$username = "root";
$password = "";
$database = "si_gudang";

$koneksi = mysqli_connect($host, $username, $password, $database);

} catch (mysqli_sql_exception $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
    exit();
}
?>