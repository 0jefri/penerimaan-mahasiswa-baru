<?php
session_start();

// Cek jika user belum login, redirect ke halaman login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - KP2MB</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: #f4f6fb;
    }

    .dashboard-container {
      display: flex;
      height: 100vh;
    }

    /* Sidebar */
    .sidebar {
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
      background: #ffffff;
      padding: 15px 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #dcdfe3;
    }

    .topbar .title {
      font-weight: bold;
      color: #1E3A8A;
      font-size: 18px;
    }

    .topbar .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #1E3A8A;
    }

    .topbar .user-icon {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #3B82F6;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
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

    .user-details {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
  </style>
</head>

<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>KP2MB</h2>
      <a href="dashboard.php">Dashboard</a>
      <a href="#">Data PMB</a>
      <a href="#">Data Master</a>
      <div class="submenu">
        <a href="#">- Fakultas</a>
        <a href="#">- Program Studi</a>
      </div>
      <a href="#">Clustering</a>
      <div class="submenu">
        <a href="#">- Hasil Clustering</a>
      </div>
    </div>

    <!-- Main -->
    <div class="main-section">
      <!-- Topbar -->
      <div class="topbar">
        <div class="title">Halaman Utama</div>
        <div class="user-info">
          <span><?php echo htmlspecialchars($_SESSION['name']); ?>
            (<?php echo htmlspecialchars($_SESSION['role']); ?>)</span>
          <div class="user-icon">👤</div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <div class="welcome-message">
          <h2>Selamat Datang di Sistem K-MEANS PMB</h2>
          <p>Kantor Promosi dan Penerimaan Mahasiswa Baru - Universitas Muhammadiyah Banjarmasin</p>
        </div>

        <div class="user-details">
          <h3>Informasi Akun</h3>
          <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
          <p><strong>Nama:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
          <p><strong>Role:</strong> <?php echo htmlspecialchars($_SESSION['role']); ?></p>

          <a href="logout.php" class="logout-btn">Logout</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>