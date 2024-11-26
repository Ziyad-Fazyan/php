<?php
//costant
define("PHI", 22/7);
echo "Masukkan jari-jari lingkaran : ";
$r = trim(fgets(STDIN));

$luas = PHI * $r * $r;

echo "Luas lingkaran dengan jari-jari $r adalah $luas \n";
?>