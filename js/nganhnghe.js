// Hiệu ứng particles nền
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
    move: { enable: true, speed: 2 },
  },
  interactivity: {
    detect_on: "canvas",
    events: {
      onhover: { enable: true, mode: "grab" },
      onclick: { enable: true, mode: "push" },
    },
    modes: {
      grab: { distance: 200 },
      push: { particles_nb: 4 },
    },
  },
  retina_detect: true,
});

// Xoá danh sách yêu thích cũ khi tải trang mới
localStorage.removeItem("favorites");
let favorites = [];

// Toggle menu cho mobile
const navMenu = document.querySelector(".nav-menu");
const logo = document.querySelector(".logo-img");
logo.addEventListener("click", () => {
  navMenu.classList.toggle("active");
});

// Menu cuộn mượt và cập nhật active
document.querySelectorAll(".nav-menu a, .footer-right a").forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    if (href.startsWith("#")) {
      e.preventDefault();
      const targetId = href.substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 60,
          behavior: "smooth",
        });
      }
      if (window.innerWidth <= 768) {
        navMenu.classList.remove("active");
      }
      document
        .querySelectorAll(".nav-link")
        .forEach((link) => link.classList.remove("active"));
      if (this.classList.contains("nav-link")) {
        this.classList.add("active");
      }
    }
  });
});

// Scroll tự cập nhật menu active
window.addEventListener("scroll", () => {
  const scrollPosition = window.scrollY;
  document.querySelectorAll(".nav-link").forEach((link) => {
    const sectionId = link.getAttribute("href").substring(1);
    const section = document.getElementById(sectionId);
    if (section) {
      const sectionTop = section.offsetTop - 100;
      const sectionBottom = sectionTop + section.offsetHeight;
      if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
        document
          .querySelectorAll(".nav-link")
          .forEach((l) => l.classList.remove("active"));
        link.classList.add("active");
      }
    }
  });
});

// Mở modal chi tiết
document.querySelectorAll(".details-btn").forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    const modalId = button.getAttribute("data-modal");
    const modal = document.getElementById(`modal-container-${modalId}`);
    modal.classList.add("active");
  });
});

// Đóng modal
function closeModals(modalId) {
  document
    .getElementById(`modal-container-${modalId}`)
    .classList.remove("active");
}
document.querySelectorAll(".modal-container").forEach((container) => {
  container.addEventListener("click", (e) => {
    if (e.target === container) container.classList.remove("active");
  });
});
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    document.querySelectorAll(".modal-container").forEach((container) => {
      container.classList.remove("active");
    });
  }
});

// Danh sách yêu thích
const favoritesList = document.getElementById("favorites-list");

function updateFavorites() {
  if (!favoritesList) return;
  favoritesList.innerHTML = "";
  favorites.forEach((item, index) => {
    const card = document.createElement("div");
    card.classList.add("industry-card", "visible");
    card.innerHTML = `
      <i class="fas fa-heart industry-icon"></i>
      <h3>${item.title}</h3>
      <div class="industry-info">${item.info}</div>
      <a href="lienhe.html" class="contact-link">Liên Hệ</a>
      <button class="remove-favorite-btn" data-index="${index}" title="Xoá">X</button>
    `;
    favoritesList.appendChild(card);
  });
  localStorage.setItem("favorites", JSON.stringify(favorites));
}

// Xử lý nút yêu thích trong card
document.querySelectorAll(".industry-card .favorite-icon").forEach((icon) => {
  const card = icon.closest(".industry-card");
  const title = card.querySelector("h3").textContent;
  const info = card.querySelector(".industry-info").innerHTML;
  const industryId = icon.getAttribute("data-industry");

  icon.addEventListener("click", () => {
    const index = favorites.findIndex((fav) => fav.id === industryId);
    if (index === -1) {
      favorites.push({ id: industryId, title, info });
      icon.classList.add("active");
    } else {
      favorites.splice(index, 1);
      icon.classList.remove("active");
    }
    updateFavorites();
  });
});

// Xử lý icon yêu thích trong modal
document.querySelectorAll(".modal .favorite-icon").forEach((icon) => {
  const industryId = icon.getAttribute("data-industry");
  const modal = icon.closest(".modal");
  const title = modal.querySelector("h2").textContent;
  const info = modal.querySelector(".modal-details").innerHTML;

  icon.addEventListener("click", () => {
    const index = favorites.findIndex((fav) => fav.id === industryId);
    if (index === -1) {
      favorites.push({ id: industryId, title, info });
      icon.classList.add("active");
    } else {
      favorites.splice(index, 1);
      icon.classList.remove("active");
    }
    updateFavorites();
  });
});

// Xử lý xóa 1 item yêu thích
favoritesList?.addEventListener("click", (e) => {
  if (e.target.classList.contains("remove-favorite-btn")) {
    const index = e.target.getAttribute("data-index");
    favorites.splice(index, 1);
    document.querySelectorAll(".favorite-icon").forEach((icon) => {
      const id = icon.getAttribute("data-industry");
      if (favorites.every((fav) => fav.id !== id)) {
        icon.classList.remove("active");
      }
    });
    updateFavorites();
  }

  // Xử lý khi click vào nút "Liên Hệ" trong danh sách yêu thích
  if (e.target.classList.contains("contact-link")) {
    e.preventDefault();
    window.location.href = "lienhe.html";
  }
});

// Nút xoá tất cả
function clearFavorites() {
  favorites.length = 0;
  document.querySelectorAll(".favorite-icon").forEach((icon) => {
    icon.classList.remove("active");
  });
  updateFavorites();
}

// Scroll reveal hiệu ứng
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      }
    });
  },
  { threshold: 0.3 }
);
document
  .querySelectorAll(".industry-card")
  .forEach((card) => observer.observe(card));

// Tìm kiếm
const searchInput = document.getElementById("searchInput");
const resetBtn = document.querySelector(".reset-btn");

searchInput.addEventListener("input", function () {
  const query = this.value.trim().toLowerCase();
  let firstMatch = null;
  document.querySelectorAll(".industry-card").forEach((card) => {
    const title = card.querySelector("h3").textContent.toLowerCase();
    const match = query.length > 0 && title.startsWith(query);
    card.style.display = match ? "block" : "none";
    if (match && !firstMatch) firstMatch = card;
  });
  if (firstMatch) {
    window.scrollTo({ top: firstMatch.offsetTop - 100, behavior: "smooth" });
  }
});

resetBtn.addEventListener("click", () => {
  searchInput.value = "";
  document.querySelectorAll(".industry-card").forEach((card) => {
    card.style.display = "block";
  });
});

// Khởi tạo hiển thị
document.querySelectorAll(".industry-card").forEach((card) => {
  card.style.display = "block";
});
updateFavorites();

// Active menu mặc định
document
  .querySelector('.nav-link[href="nganhnghe.html"]')
  ?.classList.add("active");
