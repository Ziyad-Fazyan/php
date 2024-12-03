<?php
echo "<pre>";
echo print_r($_FILES);
echo print_r($_POST);
echo "</pre>";

echo "Ukuran : ". $_FILES['berkas']['name'];
// echo ""

$tmp = $_FILES['berkas']['tmp_name'];
$namafile = $_POST['nama'];

move_uploaded_file($tmp, "image/$namafile")

?>