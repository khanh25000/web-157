<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đăng Nhập</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>
  <video autoplay muted loop class="video-bg">
    <source src="https://assets.mixkit.co/videos/preview/mixkit-abstract-blue-motion-background-345.mp4" type="video/mp4" />
  </video>
  <div class="overlay"></div>
  <canvas id="particles"></canvas>
  <div class="login-container">
    <h2>Đăng Nhập</h2>
    <p class="welcome-text" id="welcomeText"></p>
    <form action="process_login.php" method="POST" id="loginForm">
      <div class="form-group">
        <input type="text" name="username" placeholder=" " required />
        <label for="username">Tên đăng nhập</label>
        <i class="fa fa-user icon"></i>
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" placeholder=" " required />
        <label for="password">Mật khẩu</label>
        <i class="fa fa-lock icon"></i>
        <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
      </div>
      <button type="submit" class="login-btn">Đăng Nhập</button>
      <?php if (isset($_GET['error'])): ?>
        <p class="error-message show">Tên đăng nhập hoặc mật khẩu không đúng!</p>
      <?php endif; ?>
      <div class="auth-links">
        <a href="change_password.php" class="auth-link">Quên mật khẩu?</a>
        <a href="register.php" class="auth-link">Đăng ký tài khoản</a>
      </div>
    </form>
  </div>
  <script src="js/script.js"></script>
</body>
</html>
