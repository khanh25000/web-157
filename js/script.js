particlesJS("particles-js", {
  particles: {
    number: { value: 80, density: { enable: true, value_area: 800 } },
    color: { value: "#00ddeb" },
    shape: { type: "circle" },
    opacity: { value: 0.5, random: true },
    size: { value: 3, random: true },
    line_linked: {
      enable: true,
      distance: 150,
      color: "#00ddeb",
      opacity: 0.4,
      width: 1,
    },
    move: { enable: true, speed: 2, direction: "none", random: false },
  },
  interactivity: {
    detect_on: "canvas",
    events: {
      onhover: { enable: true, mode: "grab" },
      onclick: { enable: true, mode: "push" },
    },
    modes: { grab: { distance: 200 }, push: { particles_nb: 4 } },
  },
  retina_detect: true,
});

// Xử lý menu mobile
const navMenu = document.querySelector(".nav-menu");
const logo = document.querySelector(".logo-img");
logo.addEventListener("click", () => {
  navMenu.classList.toggle("active");
});

// Xử lý scroll mượt cho các liên kết nội bộ
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    if (
      this.getAttribute("href").startsWith("#") &&
      !this.getAttribute("href").includes(".php")
    ) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement =
        document.getElementById(targetId) || document.querySelector(".hero");
      window.scrollTo({
        top: targetElement.offsetTop - 60,
        behavior: "smooth",
      });

      if (window.innerWidth <= 768) {
        navMenu.classList.remove("active");
      }

      const navLinks = document.querySelectorAll(".nav-link");
      navLinks.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");
    }
  });
});

// Xử lý modal
document.querySelectorAll(".details-btn").forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    const modalId = button.getAttribute("data-modal");
    const modal = document.getElementById(modalId);

    document.body.style.overflow = "hidden";
    document.body.classList.add("modal-open");
    modal.style.display = "flex";
    setTimeout(() => {
      modal.style.opacity = 1;
    }, 10);
  });
});

// Hàm đóng modal
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.style.opacity = 0;
  setTimeout(() => {
    modal.style.display = "none";
    document.body.style.overflow = "auto";
    document.body.classList.remove("modal-open");
  }, 300);
}

// Hàm hiển thị chi tiết
function showDetails(modalId) {
  alert("Đây là thông tin chi tiết về ngành. Vui lòng liên hệ để biết thêm!");
  closeModal(modalId);
}

// Animation cho các card khi scroll
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.transition =
          "opacity 0.5s ease, transform 0.5s ease";
        entry.target.style.opacity = 1;
        entry.target.style.transform = "translateY(0)";
      }
    });
  },
  { threshold: 0.2 }
);

// Áp dụng animation cho các card
document.querySelectorAll(".job-card, .company-card").forEach((card) => {
  observer.observe(card);
});

// Xử lý khi click vào nút đóng modal bằng cách click ra ngoài
document.querySelectorAll(".modal").forEach((modal) => {
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      const modalId = modal.id;
      closeModal(modalId);
    }
  });
});

// Xử lý phím ESC để đóng modal
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    const openModal = document.querySelector(".modal[style*='display: flex']");
    if (openModal) {
      closeModal(openModal.id);
    }
  }
});
