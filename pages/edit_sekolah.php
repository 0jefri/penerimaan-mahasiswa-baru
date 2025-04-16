<?php
require_once '../config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM sekolah WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $kecamatan = $_POST['kecamatan'];
  $kabupaten = $_POST['kabupaten'];
  $provinsi = $_POST['provinsi'];

  $stmt = $conn->prepare("UPDATE sekolah SET name=?, kecamatan=?, kabupaten=?, provinsi=? WHERE id=?");
  $stmt->bind_param("ssssi", $name, $kecamatan, $kabupaten, $provinsi, $id);

  if ($stmt->execute()) {
    header("Location: data_sekolah.php?updated=1");
    exit;
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Sekolah</title>
</head>

<body>
  <h2>Edit Sekolah</h2>
  <form method="POST">
    <label>Nama Sekolah:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Kecamatan:</label><br>
    <input type="text" name="kecamatan" value="<?= htmlspecialchars($data['kecamatan']) ?>"><br><br>

    <label>Kabupaten:</label><br>
    <input type="text" name="kabupaten" value="<?= htmlspecialchars($data['kabupaten']) ?>"><br><br>

    <label>Provinsi:</label><br>
    <input type="text" name="provinsi" value="<?= htmlspecialchars($data['provinsi']) ?>"><br><br>

    <button type="submit">Simpan Perubahan</button>
  </form>
  <br>
  <a href="data_sekolah.php">Kembali</a>
</body>

</html>