<?php

function buatTabelPerkalian($batas) {
    echo "TABEL PERKALIAN\n";
    for ($i = 0; $i <= $batas; $i++) {
        for ($j = 0; $j <= $batas; $j++) {
            printf("%5d", $i * $j);
        }
        echo "\n";
    }
    echo "\n";
}

function buatTabelPenjumlahan($batas) {
    echo "TABEL PENJUMLAHAN\n";
    for ($i = 0; $i <= $batas; $i++) {
        for ($j = 0; $j <= $batas; $j++) {
            printf("%5d", $i + $j);
        }
        echo "\n";
    }
    echo "\n";
}

function buatTabelPangkat($batas) {
    echo "TABEL PANGKAT\n";
    for ($i = 1; $i <= $batas; $i++) {
        for ($j = 1; $j <= $batas; $j++) {
            printf("%5d", $i ** $j);
        }
        echo "\n";
    }
    echo "\n";
}

echo "Masukan Angka : ";
$batasTabel = trim(fgets(STDIN));

buatTabelPerkalian($batasTabel);
buatTabelPenjumlahan($batasTabel);
buatTabelPangkat($batasTabel);
?>