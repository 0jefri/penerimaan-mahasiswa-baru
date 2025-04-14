<?php
$host = "127.0.0.1";
$username = "root";
$password = "Jefri@123";
$database = "pmb_kmeans";
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error .
    "\nPastikan:\n1. XAMPP MySQL running\n2. User/password benar\n3. Port 3306 terbuka");
}

$conn->set_charset("utf8mb4");
?>