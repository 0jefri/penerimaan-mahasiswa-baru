<?php
require_once '../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $stmt = $conn->prepare("DELETE FROM sekolah WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: data_sekolah.php?deleted=1");
  } else {
    echo "Gagal menghapus data";
  }
} else {
  echo "ID tidak valid";
}
?>