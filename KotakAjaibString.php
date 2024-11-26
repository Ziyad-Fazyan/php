<?php

/**
 *
 * Kotak Ajaib 4
 * input
 * 1, 2, 3, 4, 5, 6, 7
 * output
 * rata rata dari input
 * - baca input
 * - pecah input berdasarkan koma
 * - rubah input menjadi array
 * - rubah array menjadi integer
 * - hitung jumlah array
 * - hitung total array
 * - hitung rata rata
 * - tampilkan rata rata
 */

// baca input
echo "Masukkan input: ";
$input = trim(fgets(STDIN));

// pecah input berdasarkan koma
// rubah input menjadi array
$input = explode(",", $input);

// rubah array menjadi integer
foreach ($input as $key => $value) {
  $input[$key] = (int) $value;
}

// hitung jumlah array
$total = 0;
foreach ($input as $key => $value) {
  $total = $total + $value;
}

var_dump($total);

// hitung total element array
$jumlah_element = count($input);
// hitung rata rata dengan rumus:
$rata_rata = $total / $jumlah_element;
// total dibalagi jumlah element array
// tampilkan rata rata
echo "Rata-rata: " . $rata_rata .PHP_EOL;

var_dump($input);
