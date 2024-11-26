<?php include("inc_header.php") ?>
<?php
$judul          = "";
$kutipan        = "";
$isi            = "";
$error          = "";
$sukses         = "";

if (isset($_POST['submit'])) {
    $judul      = $_POST['judul'];
    $isi        = $_POST['isi'];
    $kutipan    = $_POST['kutipan'];

    if ($judul == '' or $isi == '') {
        $error      = "Silahkan masukkan semua data yakni adalah isi dan judul";
    }
}
?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
    <a href="halaman.php">
        << Kembali ke Halaman admin</a>
</div>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul" value="<?php echo $judul ?>" name="judul">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kutipan" value="<?php echo $kutipan ?>" name="kutipan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control"><?php echo $isi ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
           <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>