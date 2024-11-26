<?php
echo "\n";
echo "-------------------------------------------------------------------------\n";
echo "---SELAMAT DATANG DI PROGRAM PENGHITUNG LUAS DAN KELILING BANGUN DATAR---\n";
echo "-------------------------------------------------------------------------\n";
echo "\n";
echo "MENGHITUNG LUAS DAN KELILING PERSEGI \n";
echo "Masukan lebar sisi : ";
$sisi_persegi = trim(fgets(STDIN));
$sisi_persegi = null;

$luas_persegi = $sisi_persegi*$sisi_persegi;
$keliling_persegi = 4*$sisi_persegi;

echo "Luas persegi adalah : $luas_persegi \n";
echo "Keliling persegi adalah : $keliling_persegi \n";

echo "\n";
echo "--------------------------------------------\n";
echo "MENGHITUNG LUAS DAN KELILING PERSEGI PANJANG \n";
echo "Masukan panjang sisi : ";
$panjang_persegi  = trim(fgets(STDIN));
$panjang_persegi = null;
echo "Masukan lebar sisi : ";
$lebar_persegi  = trim(fgets(STDIN));
$lebar_persegi = null;

$luas_persegi_panjang = $panjang_persegi*$lebar_persegi;
$keliling_persegi_panjang = 2*($panjang_persegi+$lebar_persegi);

echo "Luas persegi panjang adalah : $luas_persegi_panjang \n";
echo "Keliling persegi panjang adalah : $keliling_persegi_panjang \n";

echo "\n";
echo "-------------------------------------\n";
echo "MENGHITUNG LUAS DAN KELILING SEGITIGA \n";
echo "Masukan nilai tinggi : ";
$t_s  = trim(fgets(STDIN));
$t_s = null;
echo "Masukan panjang sisi A / alas : ";
$a_s  = trim(fgets(STDIN));
echo "Masukan panjang sisi B : ";
$b_s  = trim(fgets(STDIN));
echo "Masukan panjang sisi C : ";
$c_s  = trim(fgets(STDIN));

$luas_segitiga = (1/2) * $a_s * $t_s;
$keliling_segitiga = $a_s + $b_s + $c_s;

echo "Luas lingkaran adalah : $luas_segitiga \n";
echo "Keliling lingkaran adalah : $keliling_segitiga \n";

echo "\n";
echo "------------------------------------ \n";
echo "MENGHITUNG LUAS DAN KELILING LINGKARAN \n";
echo "Masukan jari-jari : ";
$r_l  = trim(fgets(STDIN));

$luas_lingkaran = (22/7) * $r_l * $r_l;
$keliling_lingkaran = 2 * (22/7) * $r_l;

echo "Luas lingkaran adalah : $luas_lingkaran \n";
echo "Keliling lingkaran adalah : $keliling_lingkaran \n";

?>