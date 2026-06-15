<?php
session_start();
require_once 'User.php';
$user = new User();

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $pekerjaan = $_POST['pekerjaan'];

    if($user->login($nama, $pekerjaan)) {
        header("location:index.php");
    } else {
        $pesan = "Nama atau Pekerjaan salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Inventory PBO</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="padding: 50px;">
    <div style="max-width: 350px; margin: auto; padding: 20px; background: white; border: 1px solid #ccc;">
        <h2 style="text-align: center;">Login Admin</h2>
        <?php if(isset($pesan)) echo "<p style='color:red; text-align:center;'>$pesan</p>"; ?>
        <form method="post">
            <label>Nama:</label><br>
            <input type="text" name="nama" style="width:100%; padding:8px; margin-bottom:10px;" required>
            <label>Pekerjaan (Password):</label><br>
            <input type="password" name="pekerjaan" style="width:100%; padding:8px; margin-bottom:15px;" required>
            <button type="submit" name="submit" style="width:100%; padding:10px; background:#245bb2; color:white; border:none;">Login</button>
        </form>
    </div>
</body>
</html>