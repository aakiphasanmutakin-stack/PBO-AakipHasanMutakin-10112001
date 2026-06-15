<?php 
require_once 'User.php';
$user = new User();

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];

$user->updateData($id, $nama, $alamat, $pekerjaan);
header("location:index.php");
?>