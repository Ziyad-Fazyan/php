<?php

echo "Masukan Angka : ";
$values = trim(fgets(STDIN));

for (
    $i = $values; 
    $i > 0; 
    $i = $i - 1
) { 
    echo "$i  "; //.PHP_EOL = "\n"
}