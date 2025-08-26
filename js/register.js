document.addEventListener("DOMContentLoaded", function () {
  const canvas = document.getElementById("particles");
  const ctx = canvas.getContext("2d");
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const particles = [];
  const particleCount = 100;

  class Particle {
    constructor() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      this.size = Math.random() * 2 + 1;
      this.speedX = Math.random() * 0.5 - 0.25;
      this.speedY = Math.random() * 0.5 - 0.25;
    }
    update() {
      this.x += this.speedX;
      this.y += this.speedY;
      if (this.size > 0.2) this.size -= 0.01;
      if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
      if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
    }
    draw() {
      ctx.fillStyle = "rgba(0, 221, 235, 0.8)"; // Thay đổi màu particle thành neon
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  function initParticles() {
    for (let i = 0; i < particleCount; i++) {
      particles.push(new Particle());
    }
  }

  function animateParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    for (let i = particles.length - 1; i >= 0; i--) {
      particles[i].update();
      particles[i].draw();
      if (particles[i].size <= 0.2) {
        particles.splice(i, 1);
        particles.push(new Particle());
      }
    }
    requestAnimationFrame(animateParticles);
  }

  initParticles();
  animateParticles();

  // Hiệu ứng chữ
  const instructionText = document.getElementById("instructionText");
  const text = "Tạo tài khoản mới để bắt đầu trải nghiệm";
  let i = 0;

  function typeWriter() {
    if (i < text.length) {
      instructionText.textContent += text.charAt(i);
      i++;
      setTimeout(typeWriter, 100);
    }
  }

  setTimeout(typeWriter, 500);

  // Toggle password
  const togglePassword = document.getElementById("togglePassword");
  const passwordInput = document.getElementById("password");
  togglePassword.addEventListener("click", () => {
    const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    togglePassword.classList.toggle("fa-eye");
    togglePassword.classList.toggle("fa-eye-slash");
  });

  // Captcha
  const captchaText = document.getElementById("captchaText");
  const refreshCaptcha = document.getElementById("refreshCaptcha");
  const captchaInput = document.getElementById("captchaInput");
  let currentCaptcha = "";

  function generateCaptcha() {
    const chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let captcha = "";
    for (let i = 0; i < 6; i++) {
      captcha += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    currentCaptcha = captcha;
    captchaText.textContent = captcha;
    captchaInput.value = "";
    fetch("set_captcha.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "captcha=" + encodeURIComponent(captcha),
    });
  }

  generateCaptcha();
  refreshCaptcha.addEventListener("click", generateCaptcha);

  // Validate form
  const registerForm = document.getElementById("registerForm");
  const roleSelect = document.getElementById("role");
  registerForm.addEventListener("submit", function (e) {
    if (roleSelect.value === "") {
      e.preventDefault();
      const errorMessage = document.getElementById("errorMessage");
      errorMessage.textContent = "Vui lòng chọn vai trò!";
      errorMessage.classList.add("show");
      setTimeout(() => errorMessage.classList.remove("show"), 3000);
    } else if (captchaInput.value !== currentCaptcha) {
      e.preventDefault();
      const errorMessage = document.getElementById("errorMessage");
      errorMessage.textContent = "Mã CAPTCHA không đúng!";
      errorMessage.classList.add("show");
      setTimeout(() => errorMessage.classList.remove("show"), 3000);
      generateCaptcha();
    }
    if (!document.querySelector('input[name="captcha"]')) {
      const captchaHidden = document.createElement("input");
      captchaHidden.type = "hidden";
      captchaHidden.name = "captcha";
      captchaHidden.value = captchaInput.value;
      registerForm.appendChild(captchaHidden);
    }
  });

  // Hiệu ứng cho role select
  roleSelect.addEventListener("change", function () {
    if (this.value !== "") {
      this.style.background =
        "linear-gradient(90deg, rgba(0, 123, 255, 0.3), rgba(0, 221, 235, 0.3))";
      this.nextElementSibling.style.top = "-20px";
      this.nextElementSibling.style.left = "10px";
      this.nextElementSibling.style.fontSize = "12px";
      this.nextElementSibling.style.color = "#00ddeb";
      this.nextElementSibling.style.transition = "all 0.3s ease";
    }
  });

  // Background movement
  document.addEventListener("mousemove", (e) => {
    const video = document.querySelector(".video-bg");
    const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
    const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
    video.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
  });

  // Chỉ nhập số ở input phone
  document.getElementById("phone").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });
});
