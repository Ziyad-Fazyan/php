
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulir Pendaftaran</title>
    <style>
      body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f9fc;
      }
      h2 {
        text-align: center;
        color: #333;
        margin-top: 30px;
        font-size: 24px;
      }
      form {
        max-width: 600px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }
      label {
        display: block;
        margin-top: 15px;
        color: #555;
        font-weight: bold;
      }
      input,
      textarea {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
      }
      input:focus,
      textarea:focus {
        border-color: #007bff;
        outline: none;
      }
      button {
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
      }
      button:hover {
        background-color: #0056b3;
      }
      .radio-group {
        margin-top: 10px;
      }
      .radio-group label {
        display: inline-block;
        margin-right: 15px;
      }
      .file-upload {
        margin-top: 10px;
      }
      @media (max-width: 600px) {
        form {
          padding: 20px;
        }
        h2 {
          font-size: 20px;
        }
      }
    </style>
  </head>
  <body>
    <h2>Formulir Pendaftaran</h2>

    <form action="proses.php" method="post">
      <label for="nama">Nama Lengkap:</label>
      <input type="text" id="nama" name="nama" required />

      <label for="email">Alamat Email:</label>
      <input type="email" id="email" name="email" required />

      <label for="telepon">Nomor Telepon:</label>
      <input type="tel" id="telepon" name="telepon" required />

      <label for="tanggal-lahir">Tanggal Lahir:</label>
      <input type="date" id="tanggal-lahir" name="tanggal-lahir" required />

      <label for="alamat">Alamat:</label>
      <textarea id="alamat" name="alamat" required></textarea>

      <label for="kota">Kota:</label>
      <input type="text" id="kota" name="kota" required />

      <label for="provinsi">Provinsi:</label>
      <input type="text" id="provinsi" name="provinsi" required />

      <label for="kode-pos">Kode Pos:</label>
      <input type="text" id="kode-pos" name="kode-pos" required />

      <label>Jenis Kelamin:</label>
      <input
        type="radio"
        id="laki-laki"
        name="jenis-kelamin"
        value="laki-laki"
      />
      <label for="laki-laki">Laki-laki</label>
      <input
        type="radio"
        id="perempuan"
        name="jenis-kelamin"
        value="perempuan"
      />
      <label for="perempuan">Perempuan</label>
      <input type="radio" id="lainnya" name="jenis-kelamin" value="lainnya" />
      <label for="lainnya">Lainnya</label>

      <label for="pendidikan">Pendidikan Terakhir:</label>
      <input type="text" id="pendidikan" name="pendidikan" required />

      <label for="pekerjaan">Pekerjaan:</label>
      <input type="text" id="pekerjaan" name="pekerjaan" required />

      <label>Apakah Anda memiliki pengalaman sebelumnya di bidang ini?</label>
      <input type="radio" id="ya" name="pengalaman" value="ya" />
      <label for="ya">Ya</label>
      <input type="radio" id="tidak" name="pengalaman" value="tidak" />
      <label for="tidak">Tidak</label>

      <label for="pengalaman-jelaskan">Jika ya, mohon jelaskan:</label>
      <textarea id="pengalaman-jelaskan" name="pengalaman-jelaskan"></textarea>

      <label for="tanda-tangan">Tanda Tangan:</label>
      <input type="text" id="tanda-tangan" name="tanda-tangan" required />

      <label for="tanggal">Tanggal:</label>
      <input type="date" id="tanggal" name="tanggal" required />

      <label for="file"></label>
      <input type="file" id="file" name="file" required />

      <button type="submit">Kirim</button>
    </form>
  </body>
</html>
