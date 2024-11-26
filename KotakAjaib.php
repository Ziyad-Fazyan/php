<?php

echo "Masukan Angka : ";
$values = trim(fgets(STDIN));

for (
    $i = 1; 
    $i <= $values; 
    $i = $i + 1
) { 
    echo $i.PHP_EOL; //.PHP_EOL = "\n"
}