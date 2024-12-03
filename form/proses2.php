<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengecek apakah file diunggah tanpa kesalahan
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file'];

        // Mendapatkan informasi file
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Mendapatkan nama file kustom dari input
        $customFileName = preg_replace('/[^A-Za-z0-9_\-]/', '', $_POST['custom_name']); // Menghapus karakter yang tidak diinginkan
        if (empty($customFileName)) {
            $customFileName = 'file'; // Nama default jika kosong
        }

        // Menentukan direktori tujuan untuk menyimpan file
        $uploadDir = 'uploads/';
        // Membuat direktori jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Mengubah nama file dengan nama kustom dan ekstensi asli
        $newFileName = $customFileName . '.' . $fileExtension;

        // Menentukan path untuk menyimpan file
        $destPath = $uploadDir . $newFileName;

        // Memindahkan file ke direktori tujuan
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo "<h2>File berhasil diunggah!</h2>";
            echo "Nama File Asli: " . htmlspecialchars($fileName) . "<br>";
            echo "Nama File Kustom: " . htmlspecialchars($newFileName) . "<br>";
            echo "Ukuran File: " . $fileSize . " bytes<br>";
            echo "Tipe File: " . htmlspecialchars($fileType) . "<br>";
            echo "File disimpan di: " . htmlspecialchars($destPath) . "<br>";
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }
}