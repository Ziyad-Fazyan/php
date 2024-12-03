<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama = isset($_POST['nama']) ? $_POST['nama'] : 'Tidak ada data';
    $email = isset($_POST['email']) ? $_POST['email'] : 'Tidak ada data';
    $buku = isset($_POST['buku']) ? $_POST['buku'] : 'Tidak ada data';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : 0;
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : 'Tidak ada data';
    $kurir = isset($_POST['kurir']) ? $_POST['kurir'] : 'Tidak ada data';
    $ongkir = isset($_POST['ongkir']) ? intval($_POST['ongkir']) : 0;

    // Format date
    $tgl = isset($_POST['tgl']) ? str_pad($_POST['tgl'], 2, '0', STR_PAD_LEFT) : '00';
    $bln = isset($_POST['bln']) ? $_POST['bln'] : '00';
    $thn = isset($_POST['thn']) ? $_POST['thn'] : '0000';

    // Additional options
    $tambahan_dvd = isset($_POST['dvd']) && $_POST['dvd'] == 'ok' ? '+ DVD eBook' : '';
    $tambahan_kado = isset($_POST['kado']) && $_POST['kado'] == 'ok' ? '+ Bungkus Kado' : '';
    $tambahan_text = trim($tambahan_dvd . ' ' . $tambahan_kado);
    $tambahan_text = !empty($tambahan_text) ? $tambahan_text : 'Tidak ada';

    // Calculate Total Cost (assuming book price is 100,000)
    $harga_buku = 100000;
    $total = ($jumlah * $harga_buku) + $ongkir;
} else {
    // Redirect if accessed directly
    header("Location: form.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembelian Buku</title>
    <style>
        body {
            background-color: #F8F8F8;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 500px;
            padding: 20px;
            background-color: white;
            margin: 20px auto;
            box-shadow: 1px 0px 10px, -1px 0px 10px;
        }

        h1 {
            text-align: center;
            font-family: Cambria, "Times New Roman", serif;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        td:first-child {
            background-color: #F2F2F2;
            font-weight: bold;
            width: 40%;
        }

        td:last-child {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Konfirmasi Pembelian Buku Duniailkom</h1>

        <table>
            <tr>
                <td>Nama</td>
                <td><?= $nama ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $email ?></td>
            </tr>
            <tr>
                <td>Buku</td>
                <td><?= $buku ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td><?= $jumlah ?> buah buku</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $alamat ?></td>
            </tr>
            <tr>
                <td>Kurir Pengiriman</td>
                <td><?= $kurir ?></td>
            </tr>
            <tr>
                <td>Ongkos Kirim</td>
                <td>Rp. <?= number_format($ongkir, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Tanggal Pengiriman</td>
                <td><?= "$tgl-$bln-$thn" ?></td>
            </tr>
            <tr>
                <td>Tambahan</td>
                <td><?= "$tambahan_dvd $tambahan_kado" ?></td>
            </tr>
            <tr>
                <td>Total Biaya</td>
                <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>
</body>

</html>