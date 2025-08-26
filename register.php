<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đăng Ký Tài Khoản</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/register.css?v=3" />
</head>
<body>
  <video autoplay muted loop class="video-bg">
    <source src="https://assets.mixkit.co/videos/preview/mixkit-abstract-blue-motion-background-345.mp4" type="video/mp4" />
  </video>
  <div class="overlay"></div>
  <canvas id="particles"></canvas>
  <div class="register-container">
    <h2>Đăng Ký Tài Khoản</h2>
    <p class="instruction-text" id="instructionText"></p>
    <form id="registerForm" action="process_register.php" method="POST">
      <div class="form-group">
        <input type="text" id="username" name="username" placeholder=" " required />
        <label for="username">Tên đăng nhập</label>
        <i class="fa fa-user icon"></i>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder=" " required />
        <label for="password">Mật khẩu</label>
        <i class="fa fa-lock icon"></i>
        <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
      </div>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder=" " required />
        <label for="email">Email</label>
        <i class="fa fa-envelope icon"></i>
      </div>
      <div class="form-group">
        <input type="tel" id="phone" name="phone" placeholder=" " required maxlength="10" />
        <label for="phone">Số điện thoại</label>
        <i class="fa fa-phone icon"></i>
      </div>
      <div class="form-group">
        <select id="role" name="role" class="select-enhanced" required>
          <option value="" disabled selected></option>
          <option value="admin">Admin</option>
          <option value="user">Người tìm việc</option>
        </select>
        <label for="role">Vai trò</label>
        <i class="fa fa-user-tag icon"></i>
      </div>
      <div class="captcha-container">
        <div class="captcha-box" id="captchaText"></div>
        <button type="button" class="refresh-captcha" id="refreshCaptcha">
          <i class="fas fa-sync-alt"></i>
        </button>
        <input type="text" id="captchaInput" placeholder="Nhập mã captcha" required />
      </div>
      <button type="submit" class="register-btn">
        <i class="fas fa-user-plus"></i> Đăng Ký
      </button>
      <p class="error-message" id="errorMessage"></p>
      <p class="success-message" id="successMessage"></p>
    </form>
    <a href="index.php" class="back-to-login">
      <i class="fas fa-arrow-left"></i> Đã có tài khoản? Đăng nhập ngay
    </a>
  </div>
  <script src="js/register.js?v=3"></script>
</body>
</html>