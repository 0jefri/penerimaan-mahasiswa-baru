<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: ../index.php");
  exit;
}

// Koneksi database (sesuaikan dengan konfigurasi Anda)
require_once '../config.php';

// Query untuk mendapatkan data PMB
$tahun_akademik = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$query = "SELECT 
            ROW_NUMBER() OVER (ORDER BY m.id) AS no,
            m.tahun_akademik AS thn_akademik,
            m.nrm,
            m.name AS nama,
            m.gender,
            p.name AS pilihan_prodi,
            m.alamat,
            s.name AS asal_sekolah,
            m.jurusan AS jurusan_sekolah,
            m.email
          FROM 
            mahasiswa m
          JOIN 
            sekolah s ON m.sekolah_id = s.id
          JOIN 
            prodi p ON m.prodi_id = p.id
          WHERE
            m.tahun_akademik = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tahun_akademik);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Data PMB - KP2MB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('../assets/images/background.jpeg');
      background-color: rgba(3, 136, 244, 0.9);
      background-blend-mode: overlay;
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .dashboard-container {
      display: flex;
      height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      border-right: 3px solid;
      width: 230px;
      background: #1E3A8A;
      color: #fff;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 20px;
      color: #E0E7FF;
    }

    .sidebar a {
      color: #E0E7FF;
      padding: 12px 20px;
      text-decoration: none;
      display: block;
      transition: background 0.3s ease;
      font-size: 15px;
    }

    .sidebar a:hover {
      background: #3B82F6;
      color: #fff;
    }

    .sidebar .submenu {
      padding-left: 30px;
      font-size: 14px;
    }


    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    .data-table th,
    .data-table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }

    .data-table th {
      background-color: #1E3A8A;
      color: white;
      font-weight: bold;
    }

    .data-table tr:hover {
      background-color: #f3f4f6;
    }

    .filter-section {
      background: white;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .filter-section select,
    .filter-section button {
      padding: 8px 12px;
      border-radius: 4px;
      border: 1px solid #d1d5db;
    }

    .filter-section button {
      background-color: #1E3A8A;
      color: white;
      border: none;
      cursor: pointer;
      margin-left: 10px;
    }

    .filter-section button:hover {
      background-color: #3B82F6;
    }

    .action-icons {
      display: flex;
      gap: 10px;
    }

    .action-icons a {
      color: #1E3A8A;
      text-decoration: none;
    }

    .dashboard-container {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }


    .main-section {
      flex-grow: 1;
      padding: 20px;
      overflow-y: auto;
      background-color: #f9fafb;
    }

    .topbar {
      background-color: #1E3A8A;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .title {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }

    .user-icon {
      background-color: white;
      color: #1E3A8A;
      padding: 5px;
      border-radius: 50%;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 99;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      position: relative;
    }

    .close {
      color: #aaa;
      position: absolute;
      right: 15px;
      top: 10px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    .logout-btn {
      display: inline-block;
      margin-top: 15px;
      padding: 8px 12px;
      background-color: #DC2626;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <h2>KP2MB</h2>
      <a href="dashboard.php">Dashboard</a>
      <a href="data_pmb.php" class="active">Data PMB</a>
      <a href="#">Data Master</a>
      <div class="submenu">
        <a href="data_prodi.php">- Program Studi</a>
        <a href="data_sekolah.php">- Data Sekolah</a>
      </div>
      <a href="#">Clustering</a>
      <div class="submenu">
        <a href="#">- Hasil Clustering</a>
      </div>
    </div>

    <!-- Main -->
    <div class="main-section">
      <div class="topbar">
        <div class="title">Data Pendaftaran Mahasiswa Baru</div>
        <div class="user-info" onclick="toggleModal()">
          <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
          <div class="user-icon">👤</div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <div class="filter-section">
          <form method="GET" action="data_pmb.php">
            <label for="tahun">Pilih Tahun:</label>
            <select name="tahun" id="tahun">
              <?php
              // Generate opsi tahun (misal dari 2020-2025)
              for ($year = 2020; $year <= 2025; $year++) {
                $selected = ($year == $tahun_akademik) ? 'selected' : '';
                echo "<option value='$year' $selected>$year</option>";
              }
              ?>
            </select>
            <button type="submit">Filter</button>
          </form>
        </div>

        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Tahun Akademik</th>
              <th>NRM</th>
              <th>Nama</th>
              <th>Gender</th>
              <th>Pilihan Prodi</th>
              <th>Alamat</th>
              <th>Asal Sekolah</th>
              <th>Jurusan Sekolah</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['no'] ?></td>
                <td><?= $row['thn_akademik'] ?></td>
                <td><?= htmlspecialchars($row['nrm']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['gender']) ?></td>
                <td><?= htmlspecialchars($row['pilihan_prodi']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                <td><?= htmlspecialchars($row['jurusan_sekolah']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td class="action-icons">
                  <a href="#" title="Edit">✏️</a>
                  <a href="#" title="Hapus">❌</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="accountModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="toggleModal()">&times;</span>
      <h3>Informasi Akun</h3>
      <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
      <p><strong>Nama:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
      <p><strong>Role:</strong> <?php echo htmlspecialchars($_SESSION['role']); ?></p>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>
  </div>

  <script>
    function toggleModal() {
      const modal = document.getElementById('accountModal');
      modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
    }

    window.onclick = function (event) {
      const modal = document.getElementById('accountModal');
      if (event.target === modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>