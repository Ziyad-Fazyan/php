<?php

$time = time() + (2 * 24 * 60 * 60);
// $time = time();
echo var_dump($time);
echo "<br>";
echo date("l, d M Y", $time);
$hari = date('w');

echo "<br>" . PHP_EOL;

switch ($hari) {
    case '0':
        echo "Ahad";
        break;
    case '1':
        echo "Senin";
        break;
    case '2':
        echo "Selasa";
        break;
    case '3':
        echo "Rabu";
        break;
    case '4':
        echo "Kamis";
        break;
    case '5':
        echo "Jum'at";
        break;
    case '6':
        echo "Sabtu";
        break;
    
    default:
        echo "Maaf data tidak dikenal";
        break;
}
echo date(", d M Y", $time);

$bulan = date('n');

echo "<br>" . PHP_EOL;
$nama_hari = ['Ahad','Senin','Selasa','Rabu','Kamis',"Jum'at",'Sabtu'];
$nama_bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

echo $nama_hari[$hari];
echo date(", d ", $time);
echo $nama_bulan[$bulan];
echo date(" Y", $time);