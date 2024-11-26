<?php

$nilai_siswa = [
    "andi" => 90,
    "alex" => 80,
    "susi" => 70,
    "alan" => 55,
];

array_walk($nilai_siswa, function ($nilai, $nama) {
    echo "$nama mendapatkan nilai $nilai ";
    if ($nilai >= 80) {
        echo "Lulus <br>";
    }elseif ($nilai <= 59) {
        echo "Gagal <br>";
    }else {
        echo "Ulangi <br>";
    }
});


// explode

$nama_buah = "anggur,duren,mangga,jambu,jeruk";

$array_buah = explode(",", $nama_buah);

echo var_dump($array_buah[0]);

for ($i=0; $i < count($array_buah); $i++) { 
    echo $array_buah[$i];
    echo "<br>";
}