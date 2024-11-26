<?php
echo "Masukan nopol kendaraan anda : ";
$nopol = trim(fgets(STDIN));

$sisa_pembagian = $nopol % 2;

if ( $sisa_pembagian == 1) {
    echo "Halo, nopol $nopol adalah ganjil! \n";
} else {
    echo "Halo, nopol $nopol adalah genap! \n";
}