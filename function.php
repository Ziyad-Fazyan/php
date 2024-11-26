<?php

function sayHello($name = "ziyad") {
    echo "Hello $name" . PHP_EOL;
}

for ($i=1; $i <= 2; $i++) { 
    sayHello();
    sayHello("p");
}



function luaslingkaran(int $jarijari) {
    return (22/7) * $jarijari * $jarijari;
}

$result = luaslingkaran(true);
echo "Luas Lingkaran : " . $result . "\n" . "<br>";



function sum(int $first, int $last) {
    $total = $first + $last;
    echo "Total $first + $last = $total" . PHP_EOL;
}



function increment($input) {
    return increment($input) + 1;
}

echo increment(0); //fatal error



/**Fibonacci
 * 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, ….
 */
function fibonacci($n) {
    if ($n == 0) {
        return 0;
    }
    if ($n == 1) {
        return 1;
    }
    return fibonacci($n - 1) + fibonacci($n - 2);
}

echo fibonacci(15) . PHP_EOL;