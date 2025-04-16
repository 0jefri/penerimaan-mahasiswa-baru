<?php
require_once '../config.php';
$id = $_POST['id'];
$nama = $_POST['nama_prodi'];

$sql = "UPDATE prodi SET name = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nama, $id);
$stmt->execute();

header("Location: data_prodi.php");
exit;
