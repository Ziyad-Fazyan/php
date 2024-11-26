<?php

echo "Masukan Angka : ";
$values = trim(fgets(STDIN));

for (
    $i = 1; 
    $i < $values; 
    $i = $i + 1
) { 
    echo "$i "; //.PHP_EOL = "\n"
}
for (
    $i = $values; 
    $i > 0; 
    $i = $i - 1
) { 
    echo "$i "; //.PHP_EOL = "\n"
}