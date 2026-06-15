<?php 
require_once 'User.php';
$user = new User();

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];

$user->tambahData($nama, $alamat, $pekerjaan);
header("location:index.php");
?>