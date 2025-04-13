<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-MEANS PMB - Login</title>
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
      display: flex;
      width: 80%;
      max-width: 1000px;
      background: rgba(9, 88, 152, 0.9);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .left-side {
      flex: 1;
      padding: 50px;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .vertical-line {
      width: 1px;
      background: white;
      align-self: stretch;
    }

    .right-side {
      flex: 1;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    h1 {
      font-size: 64px;
      margin-bottom: 20px;
      line-height: 1;
      color: white;
      font-weight: bold;
    }

    .subtitle {
      font-size: 20px;
      color: white;
    }

    .login-form {
      width: 100%;
      max-width: 350px;
    }

    .user-icon {
      text-align: center;
      font-size: 24px;
      margin-bottom: 15px;
      color: #333;
    }

    .login-title {
      font-size: 28px;
      color: white;
      margin-bottom: 30px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: white;
      font-size: 16px;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      background: white;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background: #808080;
      color: white;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 25px;
    }

    .login-btn:hover {
      background: #666;
    }
  </style>
</head>

<body>
  <header class="header">
    <img src="assets/images/logo.jpeg" alt="Logo" class="header-logo">
    <div class="header-text">
      <div class="header-title">Penerimaan Mahasiswa Baru</div>
      <div class="header-subtitle">Universitas Muhammadiyah Banjarmasin</div>
    </div>
  </header>

  <div class="main-content">
    <div class="container">
      <div class="left-side">
        <h1>K-MEANS<br>PMB</h1>
        <p class="subtitle">Universitas Muhammadiyah Banjarmasin</p>
      </div>
      <div class="vertical-line"></div>
      <div class="right-side">
        <div class="user-icon">👤</div>
        <h2 class="login-title">Login</h2>
        <form class="login-form" action="dashboard.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>
          <button type="submit" class="login-btn">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>