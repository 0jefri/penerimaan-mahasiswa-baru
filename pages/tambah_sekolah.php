<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $kecamatan = $_POST['kecamatan'];
  $kabupaten = $_POST['kabupaten'];
  $provinsi = $_POST['provinsi'];

  $stmt = $conn->prepare("INSERT INTO sekolah (name, kecamatan, kabupaten, provinsi) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $kecamatan, $kabupaten, $provinsi);

  if ($stmt->execute()) {
    header("Location: data_sekolah.php?success=1");
    exit;
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tambah Sekolah</title>
</head>

<body>
  <h2>Tambah Sekolah</h2>
  <form method="POST">
    <label>Nama Sekolah:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Kecamatan:</label><br>
    <input type="text" name="kecamatan"><br><br>

    <label>Kabupaten:</label><br>
    <input type="text" name="kabupaten"><br><br>

    <label>Provinsi:</label><br>
    <input type="text" name="provinsi"><br><br>

    <button type="submit">Simpan</button>
  </form>
  <br>
  <a href="data_sekolah.php">Kembali</a>
</body>

</html>