<?php
function luasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}
function luaspersegi($sisi) {
    return 2*$sisi;
}
echo "Luas persegi panjang: " . luasPersegiPanjang(5, 10) . "\n";
echo "Luas persegi panjang 2: " . luasPersegiPanjang(7, 9) . "\n";
echo "Luas Persegi: " . luaspersegi(6);
?>