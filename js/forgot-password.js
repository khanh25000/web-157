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
      ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
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
  const text = "Vui lòng nhập thông tin để đặt lại mật khẩu";
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
  const toggleNewPassword = document.getElementById("toggleNewPassword");
  const newPasswordInput = document.getElementById("newPassword");
  toggleNewPassword.addEventListener("click", () => {
    const type = newPasswordInput.type === "password" ? "text" : "password";
    newPasswordInput.type = type;
    toggleNewPassword.classList.toggle("fa-eye");
    toggleNewPassword.classList.toggle("fa-eye-slash");
  });

  const toggleConfirmPassword = document.getElementById(
    "toggleConfirmPassword"
  );
  const confirmPasswordInput = document.getElementById("confirmPassword");
  toggleConfirmPassword.addEventListener("click", () => {
    const type = confirmPasswordInput.type === "password" ? "text" : "password";
    confirmPasswordInput.type = type;
    toggleConfirmPassword.classList.toggle("fa-eye");
    toggleConfirmPassword.classList.toggle("fa-eye-slash");
  });

  // Parallax background
  document.addEventListener("mousemove", (e) => {
    const video = document.querySelector(".video-bg");
    const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
    const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
    video.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
  });
});
