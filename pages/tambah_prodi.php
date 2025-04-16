<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_prodi'] ?? '';
  $nama = $_POST['nama_prodi'] ?? '';

  if (!empty($id) && !empty($nama)) {
    $sql = "INSERT INTO prodi (id, name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $nama);

    if ($stmt->execute()) {
      header("Location: data_prodi.php");
      exit;
    } else {
      echo "<p style='color:red;'>Gagal menyimpan data: " . $stmt->error . "</p>";
    }
  } else {
    echo "<p style='color:red;'>ID dan Nama Prodi tidak boleh kosong.</p>";
  }
}
?>