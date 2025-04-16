<?php
require_once '../config.php';
$id = $_POST['id'];

$sql = "DELETE FROM prodi WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: data_prodi.php");
exit;
