<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Unggah File</title>
</head>

<body>
    <h1>Form Unggah File</h1>
    <form action="proses2.php" method="post" enctype="multipart/form-data">
        <label for="file">Pilih file gambar untuk diunggah:</label><br>
        <input type="file" id="file" name="file" accept="image/*" required><br><br>

        <label for="custom_name">Nama File Kustom (tanpa ekstensi):</label><br>
        <input type="text" id="custom_name" name="custom_name" required><br><br>

        <input type="submit" value="Unggah">
    </form>
</body>

</html>