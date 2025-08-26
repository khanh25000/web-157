// Kiểm tra Particles.js
if (typeof particlesJS === "undefined") {
  console.error("Particles.js không được tải!");
} else {
  particlesJS("particles-js", {
    particles: {
      number: { value: 60, density: { enable: true, value_area: 1000 } },
      color: { value: "#00ddeb" },
      shape: { type: "circle" },
      opacity: { value: 0.4, random: true },
      size: { value: 3, random: true },
      line_linked: {
        enable: true,
        distance: 150,
        color: "#00ddeb",
        opacity: 0.3,
        width: 1,
      },
      move: { enable: true, speed: 1.5, direction: "none", random: false },
    },
    interactivity: {
      detect_on: "canvas",
      events: {
        onhover: { enable: true, mode: "grab" },
        onclick: { enable: true, mode: "push" },
      },
      modes: { grab: { distance: 200 }, push: { particles_nb: 3 } },
    },
    retina_detect: true,
  });
}

// Xử lý menu mobile
const navMenu = document.querySelector(".nav-menu");
const logo = document.querySelector(".logo-img");
if (logo) {
  logo.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });
}

// Xử lý scroll mượt
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
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: "smooth",
        });
      } else {
        console.warn(`Không tìm thấy phần tử với id: ${targetId}`);
      }

      if (window.innerWidth <= 768) {
        navMenu.classList.remove("active");
      }

      const navLinks = document.querySelectorAll(".nav-link");
      navLinks.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");
    }
  });
});

// IntersectionObserver
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.transition =
          "opacity 0.5s ease, transform 0.5s ease";
        entry.target.style.opacity = 1;
        entry.target.style.transform = "translateY(0)";
        observer.unobserve(entry.target); // Ngừng quan sát sau khi áp dụng
      }
    });
  },
  { threshold: 0.1 }
);

document.querySelectorAll(".card").forEach((card) => {
  observer.observe(card);
});
