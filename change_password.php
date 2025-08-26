<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đổi Mật Khẩu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/forgot-password.css" />
</head>
<body>
  <video autoplay muted loop class="video-bg">
    <source src="https://assets.mixkit.co/videos/preview/mixkit-abstract-blue-motion-background-345.mp4" type="video/mp4" />
  </video>
  <div class="overlay"></div>
  <canvas id="particles"></canvas>
  <div class="password-container">
    <h2>Đổi Mật Khẩu</h2>
    <p class="instruction-text" id="instructionText"></p>
    <form id="passwordForm" action="process_change.php" method="POST">
      <div class="form-group">
        <input type="text" id="username" name="username" placeholder=" " required />
        <label for="username">Tên đăng nhập</label>
        <i class="fa fa-user icon"></i>
      </div>

      <div class="form-group">
        <input type="password" id="newPassword" name="newPassword" placeholder=" " required />
        <label for="newPassword">Mật khẩu mới</label>
        <i class="fa fa-lock icon"></i>
        <i class="fa fa-eye-slash toggle-password" id="toggleNewPassword"></i>
      </div>

      <div class="form-group">
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder=" " required />
        <label for="confirmPassword">Xác nhận mật khẩu</label>
        <i class="fa fa-lock icon"></i>
        <i class="fa fa-eye-slash toggle-password" id="toggleConfirmPassword"></i>
      </div>

      <button type="submit" class="submit-btn">
        <i class="fas fa-sync-alt"></i> Đặt lại mật khẩu
      </button>

      <p class="error-message" id="errorMessage"></p>
      <p class="success-message" id="successMessage"></p>
    </form>

    <a href="index.php" class="back-to-login">
      <i class="fas fa-arrow-left"></i> Quay lại đăng nhập
    </a>
  </div>

  <script src="js/forgot-password.js"></script>
</body>
</html>
