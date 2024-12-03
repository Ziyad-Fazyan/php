<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal-lahir']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $kota = htmlspecialchars($_POST['kota']);
    $provinsi = htmlspecialchars($_POST['provinsi']);
    $kode_pos = htmlspecialchars($_POST['kode-pos']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis-kelamin']);
    $pendidikan = htmlspecialchars($_POST['pendidikan']);
    $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
    $pengalaman = htmlspecialchars($_POST['pengalaman']);
    $pengalaman_jelaskan = htmlspecialchars($_POST['pengalaman-jelaskan']);
    $tanda_tangan = htmlspecialchars($_POST['tanda-tangan']);
    $tanggal = htmlspecialchars($_POST['tanggal']);

    // Jika ada file yang diupload
    if (isset($_FILES['file'])) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];

        // Cek jika tidak ada error
        if ($file_error === 0) {
            // Anda bisa memindahkan file ke direktori yang diinginkan
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
        } else {
            echo "Ada kesalahan saat mengupload file.";
        }
    }

    // Menampilkan data
    echo "<h2>Data Pendaftaran</h2>";
    echo "<p><strong>Nama Lengkap:</strong> $nama</p>";
    echo "<p><strong>Alamat Email:</strong> $email</p>";
    echo "<p><strong>Nomor Telepon:</strong> $telepon</p>";
    echo "<p><strong>Tanggal Lahir:</strong> $tanggal_lahir</p>";
    echo "<p><strong>Alamat:</strong> $alamat</p>";
    echo "<p><strong>Kota:</strong> $kota</p>";
    echo "<p><strong>Provinsi:</strong> $provinsi</p>";
    echo "<p><strong>Kode Pos:</strong> $kode_pos</p>";
    echo "<p><strong>Jenis Kelamin:</strong> $jenis_kelamin</p>";
    echo "<p><strong>Pendidikan Terakhir:</strong> $pendidikan</p>";
    echo "<p><strong>Pekerjaan:</strong> $pekerjaan</p>";
    echo "<p><strong>Pengalaman:</strong> $pengalaman</p>";
    if ($pengalaman === "ya") {
        echo "<p><strong>Jelaskan Pengalaman:</strong> $pengalaman_jelaskan</p>";
    }
    echo "<p><strong>Tanda Tangan:</strong> $tanda_tangan</p>";
    echo "<p><strong>Tanggal:</strong> $tanggal</p>";

    // Menampilkan nama file yang diupload jika ada
    if (isset($file_name)) {
        echo "<p><strong>File yang diupload:</strong> $file_name</p>";
    }
} else {
    echo "Metode permintaan tidak valid.";
}
?>