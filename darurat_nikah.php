<?php

echo "Masukan nama anda: ";
//Membaca input dari pengguna
$nama = trim(fgets(STDIN));
echo "Masukan umur anda: ";
//Membaca input dari pengguna
$umur = trim(fgets(STDIN));

if ( $umur <= 25) {
    echo "Halo, $nama $umur belum wajib nikah! \n";
} else {
    echo "Halo, $nama $umur wajib segera nikah! \n";
}

?>