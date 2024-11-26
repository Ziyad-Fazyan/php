<?php

echo "Masukan Angka : ";
$values = trim(fgets(STDIN));

for (
    $i = 1; 
    $i <= $values; 
    $i = $i + 1
) {
    for (
        $j = 1; 
        $j <= $values; 
        $j = $j + 1
    ) { 
      echo "$j "; //.PHP_EOL = "\n"
    }
    echo "".PHP_EOL;
} 