<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: ../index.php");
  exit;
}

require_once '../config.php';

// Query untuk mendapatkan data prodi
$sql = "SELECT * FROM prodi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Data Program Studi - KP2MB</title>
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

    /* Main section */
    .main-section {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Topbar */
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

    .topbar .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }

    .topbar .user-icon {
      background-color: white;
      color: #1E3A8A;
      padding: 5px;
      border-radius: 50%;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 30px;
      border-radius: 8px;
      width: 400px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    .close {
      position: absolute;
      right: 15px;
      top: 10px;
      font-size: 20px;
      font-weight: bold;
      color: #333;
      cursor: pointer;
    }

    .modal-content h3 {
      margin-bottom: 15px;
      color: #1E3A8A;
    }

    .modal-content p {
      margin-bottom: 10px;
    }

    .logout-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 8px 16px;
      background: #ef4444;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }

    .logout-btn:hover {
      background: #dc2626;
    }

    /* Content */
    .content {
      padding: 30px;
      color: #1f2937;
      font-size: 16px;
    }

    .welcome-message {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    /* Tambahan style untuk tabel prodi */
    .content-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .btn-tambah {
      background-color: #1E3A8A;
      color: white;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .btn-tambah:hover {
      background-color: #3B82F6;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
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

    .action-icons {
      display: flex;
      gap: 10px;
    }

    .action-icons a {
      color: #1E3A8A;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <h2>KP2MB</h2>
      <a href="dashboard.php">Dashboard</a>
      <a href="data_pmb.php">Data PMB</a>
      <a href="#">Data Master</a>
      <div class="submenu">
        <a href="data_prodi.php" class="active">- Program Studi</a>
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
        <div class="title">Halaman Data Prodi</div>
        <div class="user-info" onclick="toggleModal()">
          <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
          <div class="user-icon">👤</div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <div class="content-header">
          <h3>Data Program Studi</h3>
          <a href="javascript:void(0)" onclick="toggleModal('modalTambah')" class="btn-tambah">
            <span>+</span> Tambah
          </a>

        </div>

        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Program Studi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td class="action-icons">
                  <a href="javascript:void(0)"
                    onclick="bukaEditModal('<?= $row['id'] ?>', '<?= htmlspecialchars($row['name']) ?>')"
                    title="Edit">✏️</a>
                  <a href="javascript:void(0)" onclick="bukaHapusModal('<?= $row['id'] ?>')" title="Hapus">❌</a>
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

  <div id="modalTambah" class="modal">
    <div class="modal-content">
      <span class="close" onclick="toggleModal('modalTambah')">&times;</span>
      <h3>Tambah Program Studi</h3>
      <form action="tambah_prodi.php" method="POST">
        <input type="text" name="id_prodi" placeholder="ID Prodi (ex: PR001)" required>
        <br><br>
        <input type="text" name="nama_prodi" placeholder="Nama Program Studi" required>
        <br><br>
        <button type="submit">Simpan</button>
      </form>

    </div>
  </div>

  <!-- Modal Edit -->
  <div id="modalEdit" class="modal">
    <div class="modal-content">
      <span class="close" onclick="toggleModal('modalEdit')">&times;</span>
      <h3>Edit Program Studi</h3>
      <form action="edit_prodi.php" method="POST">
        <input type="hidden" name="id" id="edit_id">
        <input type="text" name="nama_prodi" id="edit_nama_prodi" required>
        <br><br>
        <button type="submit">Update</button>
      </form>
    </div>
  </div>

  <!-- Modal Hapus -->
  <div id="modalHapus" class="modal">
    <div class="modal-content">
      <span class="close" onclick="toggleModal('modalHapus')">&times;</span>
      <h3>Konfirmasi Hapus</h3>
      <form action="hapus_prodi.php" method="POST">
        <input type="hidden" name="id" id="hapus_id">
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <button type="submit">Ya, Hapus</button>
      </form>
    </div>
  </div>

  <script>
    function toggleModal(id = 'accountModal') {
      const modal = document.getElementById(id);
      if (modal) modal.style.display = (modal.style.display === 'block' ? 'none' : 'block');
    }

    function bukaEditModal(id, nama) {
      document.getElementById('edit_id').value = id;
      document.getElementById('edit_nama_prodi').value = nama;
      toggleModal('modalEdit');
    }

    function bukaHapusModal(id) {
      document.getElementById('hapus_id').value = id;
      toggleModal('modalHapus');
    }

    window.onclick = function (event) {
      ['modalTambah', 'modalEdit', 'modalHapus', 'accountModal'].forEach(id => {
        const modal = document.getElementById(id);
        if (event.target === modal) modal.style.display = "none";
      });
    };
  </script>
</body>

</html>