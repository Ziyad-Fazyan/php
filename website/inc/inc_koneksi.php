<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "dbphpbasic";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Gagal terkoneksi");
}else {
    echo "Koneksi berhasil";
}