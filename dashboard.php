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
      /* deep navy blue */
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
      /* soft blue hover */
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
  </style>
</head>

<body>

  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>KP2MB</h2>
      <a href="#">Dashboard</a>
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
          <span>Admin</span>
          <div class="user-icon">👤</div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <p>Kantor Promosi dan Penerimaan Mahasiswa Baru</p>
      </div>
    </div>
  </div>

</body>

</html>