<?php
function luaskubus($sisi_k) {
    return 6*($sisi_k*$sisi_k);
}
function kelilingkubus($sisi) {
    return 12*$sisi;
}
function luasbalok($panjang, $lebar, $tinggi) {
    return 2*($panjang*$lebar+$panjang*$tinggi+$lebar*$tinggi);
}
function kelilingbalok($panjang, $lebar, $tinggi) {
    return 4*($panjang+$lebar+$tinggi);
}
function luaspermukaanbola($jarijari) {
    return 4*(22/7)*($jarijari*$jarijari);
}
function kelilingbola($jarijari) {
    return 2*(22/7)*$jarijari;
}
function luaspermukaantabung($r, $t) {
    return 2*(22/7)*$r*($r+$t);
}
function kelilingtabung($r) {
    return 2*(22/7)*$r;
}

echo "Luas Permukaan dan Keliling Kubus" . "\n" . "<br>";
echo "Luas Permukaan Kubus : " . luaskubus(8) . "\n" . "<br>";
echo "Keliling Kubus : " . kelilingkubus(8) . "\n" . "<br>";
echo "\n" . "<br>";
echo "Luas Permukaan dan Keliling Balok" . "\n" . "<br>";
echo "Luas Permukaan Balok: " . luasbalok(6, 8, 5) . "\n" . "<br>";
echo "Keliling Balok: " . kelilingbalok(6, 8, 5) . "\n" . "<br>";
echo "\n" . "<br>";
echo "Luas Permukaan dan Keliling Bola" . "\n" . "<br>";
echo "Luas Permukaan Bola : " . luaspermukaanbola(12) . "\n" . "<br>";
echo "Keliling Bola : " . kelilingbola(12) . "\n" . "<br>";
echo "\n" . "<br>";
echo "Luas Permukaan dan Keliling Tabung" . "\n" . "<br>";
echo "Luas Permukaan Tabung: " . luaspermukaantabung(9, 7) . "\n" . "<br>";
echo "Keliling Tabung: " . kelilingtabung(9) . "\n" . "<br>";
?>