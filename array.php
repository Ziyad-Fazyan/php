<?php

$values = array(10, 9, 8, 7.5);

$cars = array("Toyota", "Honda", "Suzuki");
var_dump($cars[2]);

unset($cars[2]);
var_dump($cars[2]);

$names = ["Ziyad", "Ibrohim", "Nabil"];
var_dump($names[1]);

for (
    $i=0; 
    $i < 4; 
    $i++
) { 
    echo "Data ke $i = $values[$i]".PHP_EOL; //.PHP_EOL = "\n"
}