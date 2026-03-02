<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
</head>
<body>
    <h2> input data produk <h2>
    <form action="proses_produk.php" method="post">
        Nama Produk:
        <input type="text" name="nama"><br><br>

        Harga: 
        <input type="number" name="harga"><br><br>
        <input type="submit" value="Simpan">
    </form>
<?php 
$nama   =$_POST['nama'];
$harga  =$_POST['harga'];

echo "<h2> Data Produk</h2>";
echo "Nama Produk: ".$nama."<br>";
echo "Harga : Rp " . $harga;

$nama = htmlspecialchars($_POST['nama']);
$harga = htmlspecialchars($_POST['harga']);
?>

</body>
</html>