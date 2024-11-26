<?php
// Fungsi untuk membuat tabel perkalian
function buatTabelPerkalian($batas) {
    echo "<h2>Tabel Perkalian</h2>";
    echo "<table border='1'>";
    echo "<tr><th>×</th>";
    
    // Header kolom
    for ($i = 1; $i <= $batas; $i++) {
        echo "<th>$i</th>";
    }
    echo "</tr>";
    
    // Isi tabel perkalian
    for ($i = 1; $i <= $batas; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 1; $j <= $batas; $j++) {
            echo "<td>" . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Fungsi untuk membuat tabel penjumlahan
function buatTabelPenjumlahan($batas) {
    echo "<h2>Tabel Penjumlahan</h2>";
    echo "<table border='1'>";
    echo "<tr><th>+</th>";
    
    // Header kolom
    for ($i = 1; $i <= $batas; $i++) {
        echo "<th>$i</th>";
    }
    echo "</tr>";
    
    // Isi tabel penjumlahan
    for ($i = 1; $i <= $batas; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 1; $j <= $batas; $j++) {
            echo "<td>" . ($i + $j) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Fungsi untuk membuat tabel pangkat
function buatTabelPangkat($batas) {
    echo "<h2>Tabel Pangkat</h2>";
    echo "<table border='1'>";
    echo "<tr><th>^</th>";
    
    // Header kolom
    for ($i = 1; $i <= $batas; $i++) {
        echo "<th>$i</th>";
    }
    echo "</tr>";
    
    // Isi tabel pangkat
    for ($i = 1; $i <= $batas; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 1; $j <= $batas; $j++) {
            echo "<td>" . pow($i, $j) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Tentukan batas tabel (misalnya 10)
$batasTabel = 10;

// Panggil fungsi-fungsi untuk membuat tabel
buatTabelPerkalian($batasTabel);
buatTabelPenjumlahan($batasTabel);
buatTabelPangkat($batasTabel);
?>