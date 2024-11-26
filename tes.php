<?php

echo("hallo dunia") . "<br>";
$a = 5 . "<br>";
echo $a++ . "<br>";
echo $a . "<br>";

echo "Masukkan nama buah : ";
$nama_buah = trim(fgets(STDIN));

switch ($nama_buah) {
    case 'jeruk':
        echo "jeruk sangat enak" . "<br>";
        break;
    case 'apel':
        echo "apel sangat enak" . "<br>";
        break;
    case 'melon':
        echo "melon sangat enak" . "<br>";
        break;
    
    default:
        echo "tidak ada buah" . "<br>";
        break;
}



$hasil = (7 > 5) ? "benar" : "salah";
echo $hasil . "<br>"; //benar
