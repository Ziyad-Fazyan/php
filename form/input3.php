<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Upload File</h1>    
    <!-- setiap tipe input  'file' maka harus menggunakan enctypr -->
    <form action="proses.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>File</legend>
            <p>
                <label for="">Nama : </label>
                <input type="text" name="nama">
            </p>
            <p>
                <label for="">Upload : </label>
                <input type="file" name="berkas">
            </p>
            <p>
                <input type="submit" name="" id="">
            </p>
        </fieldset>
    </form>
</body>
</html>