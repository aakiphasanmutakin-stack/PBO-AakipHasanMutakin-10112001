<?php
echo "Silahkan Masukkan username: \n";
$input_name= fopen("php://stdin", "r");
$name= trim(fgets($input_name));
echo "welcome , $name\n";
?>