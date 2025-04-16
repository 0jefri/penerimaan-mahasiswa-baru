<?php
session_start();
include '../config.php';

// Cek jika user sudah login, redirect ke dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header("Location: dashboard.php");
  exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $conn->real_escape_string($_POST['username']);
  $name = $conn->real_escape_string($_POST['name']);
  $role = $conn->real_escape_string($_POST['role']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validasi
  if (empty($username) || empty($name) || empty($role) || empty($password) || empty($confirm_password)) {
    $error = "Semua field harus diisi!";
  } elseif ($password !== $confirm_password) {
    $error = "Password dan konfirmasi password tidak cocok!";
  } else {
    // Cek apakah username sudah ada
    $check_sql = "SELECT id FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
      $error = "Username sudah digunakan!";
    } else {
      // Hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Insert user baru
      $insert_sql = "INSERT INTO users (username, name, role, password) VALUES ('$username', '$name', '$role', '$hashed_password')";

      if ($conn->query($insert_sql) === TRUE) {
        $success = "Registrasi berhasil! Anda akan dialihkan ke halaman login dalam 3 detik.";
        echo "<script>
  setTimeout(function() {
    window.location.href = '../index.php';
  }, 3000);
</script>";

      } else {
        $error = "Error: " . $conn->error;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-MEANS PMB - Register</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-image: url('assets/images/background.jpeg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header-logo {
      width: 50px;
      height: 50px;
      margin-right: 15px;
    }

    .header-text {
      display: flex;
      flex-direction: column;
    }

    .header-title {
      font-size: 20px;
      font-weight: bold;
      color: #333;
    }

    .header-subtitle {
      font-size: 16px;
      color: #FF0000;
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
      background: rgba(5, 137, 244, 0.6);
    }

    .container {
      position: relative;
      width: 80%;
      max-width: 600px;
      background: rgba(9, 88, 152, 0.9);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 50px;
      color: white;
    }

    .register-form {
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
    }

    .user-icon {
      text-align: center;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .register-title {
      font-size: 28px;
      margin-bottom: 30px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 16px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      background: white;
    }

    .register-btn {
      width: 100%;
      padding: 12px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 25px;
    }

    .register-btn:hover {
      background: #45a049;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
    }

    .login-link a {
      color: #aaccff;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: #ffcccc;
      text-align: center;
      margin-bottom: 15px;
    }

    .success-message {
      color: #ccffcc;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>
  <header class="header">
    <img src="../assets/images/logo.jpeg" alt="Logo" class="header-logo">
    <div class="header-text">
      <div class="header-title">Penerimaan Mahasiswa Baru</div>
      <div class="header-subtitle">Universitas Muhammadiyah Banjarmasin</div>
    </div>
  </header>
  <div class="main-content">
    <div class="container">
      <div class="user-icon">👤</div>
      <h2 class="register-title">Register</h2>

      <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
      <?php endif; ?>

      <form class="register-form" action="register.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select id="role" name="role" required>
            <option value="">Pilih Role</option>
            <option value="staff">Staff</option>
            <option value="pimpinan">Pimpinan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="confirm_password">Konfirmasi Password</label>
          <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="register-btn">Register</button>
        <div class="login-link">
          Sudah punya akun? <a href="../index.php">Login disini</a>
        </div>
      </form>
    </div>
  </div>

  <div id="successModal"
    style="display: none; position: fixed; z-index: 999; background: rgba(0,0,0,0.7); top:0; left:0; width:100%; height:100%; align-items: center; justify-content: center;">
    <div style="background: white; color: black; padding: 30px; border-radius: 10px; text-align: center;">
      <h3>✅ Registrasi Berhasil!</h3>
      <p>Anda akan diarahkan ke halaman login dalam 3 detik...</p>
    </div>
  </div>
  <script>
    // Tampilkan modal jika registrasi berhasil
    <?php if (!empty($success)): ?>
      document.getElementById("successModal").style.display = "flex";
      setTimeout(function () {
        window.location.href = "../index.php";
      }, 3000);
    <?php endif; ?>
  </script>

</body>

</html>