<?php
session_start();
require_once 'db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra vai trò người dùng
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if ($role !== 'user' && $role !== 'admin') {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy danh sách ngành nghề mới nhất (giới hạn 1 ngành)
$sql_newest = "SELECT * FROM industries ORDER BY created_at DESC LIMIT 1";
$result_newest = $conn->query($sql_newest);
$newest_industry = $result_newest ? $result_newest->fetch_assoc() : null;

// Hàm gán hình ảnh cho ngành nghề mới nhất
function getIndustryImage($industry_name) {
    $image_map = [
        'Công Nghệ Thông Tin' => 'images/cntt.jpg',
        'Thiết Kế Đồ Họa' => 'images/thietke.jpg',
        'Khoa Học Dữ Liệu' => 'images/data.jpg',
        'An Ninh Mạng' => 'images/security.jpg',
        'Marketing' => 'images/marketing.jpg',
        'Y Tế' => 'images/healthcare.jpg',
        'Logistics' => 'images/logistics.jpg',
        'Game' => 'images/game.jpg'
    ];
    return isset($image_map[$industry_name]) ? $image_map[$industry_name] : 'images/industry.jpg';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css?v=8" />
</head>
<body>
    <!-- Navigation -->
    <nav>
        <img src="images/logo.png" alt="Logo" class="logo-img" onerror="this.src='https://via.placeholder.com/40';">
        <ul class="nav-menu">
            <li><a href="#home" class="nav-link active">Trang Chủ</a></li>
            <li><a href="./nganhnghe.html" class="nav-link">Ngành Nghề</a></li>
            <li><a href="./camnang.html" class="nav-link">Cẩm Nang</a></li>
            <li><a href="./lienhe.html" class="nav-link">Liên Hệ</a></li>
            <li><a href="./topcv.html" class="nav-link">Top CV</a></li>
            <li><a href="logout.php" class="logout-btn">Đăng Xuất</a></li>
        </ul>
    </nav>

    <!-- Particle Background -->
    <div id="particles-js"></div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <h1>Khám Phá Cơ Hội Nghề Nghiệp</h1>
    </section>

    <!-- Job Categories -->
    <section class="job-categories" id="industries">
        <div class="container">
            <h2>Ngành Nghề Mới Nhất</h2>
            <?php if ($newest_industry): ?>
                <div class="category-container">
                    <div class="job-card" data-modal="modal-<?php echo $newest_industry['id']; ?>">
                        <div class="image-container">
                            <img src="<?php echo getIndustryImage($newest_industry['name']); ?>" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                        </div>
                        <h3><?php echo htmlspecialchars($newest_industry['name']); ?></h3>
                        <p class="job-salary">Mức lương: <?php echo htmlspecialchars($newest_industry['salary']); ?></p>
                        <p class="job-location">Địa điểm: <?php echo htmlspecialchars($newest_industry['location']); ?></p>
                        <a href="#" class="details-btn" data-modal="modal-<?php echo $newest_industry['id']; ?>">Giới Thiệu</a>
                    </div>
                    <!-- Modal cho ngành mới nhất -->
                    <div id="modal-<?php echo $newest_industry['id']; ?>" class="modal">
                        <div class="modal-content">
                            <h3><?php echo htmlspecialchars($newest_industry['name']); ?></h3>
                            <p><?php echo htmlspecialchars($newest_industry['description']); ?></p>
                            <button class="close-btn" onclick="closeModal('modal-<?php echo $newest_industry['id']; ?>')">Đóng</button>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="no-data">Không có ngành nghề mới nào.</p>
            <?php endif; ?>

            <h2>Ngành Nghề Hot Năm 2025</h2>
            <div class="category-container">
                <div class="job-card" data-modal="modal-1">
                    <div class="image-container">
                        <img src="img/cntt.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Công Nghệ Thông Tin</h3>
                    <p class="job-salary">Mức lương: $80k - $160k</p>
                    <p class="job-location">Địa điểm: Làm việc từ xa</p>
                    <a href="#" class="details-btn" data-modal="modal-1">Giới Thiệu</a>
                </div>
                <div id="modal-1" class="modal">
                    <div class="modal-content">
                        <h3>Công Nghệ Thông Tin</h3>
                        <p>Ngành Công Nghệ Thông Tin tập trung vào phát triển và quản lý các hệ thống công nghệ, bao gồm lập trình, mạng, và bảo mật.</p>
                        <button class="close-btn" onclick="closeModal('modal-1')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-2">
                    <div class="image-container">
                        <img src="img/dohoa.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Thiết Kế Đồ Họa</h3>
                    <p class="job-salary">Mức lương: $70k - $120k</p>
                    <p class="job-location">Địa điểm: TP. Hồ Chí Minh</p>
                    <a href="#" class="details-btn" data-modal="modal-2">Giới Thiệu</a>
                </div>
                <div id="modal-2" class="modal">
                    <div class="modal-content">
                        <h3>Thiết Kế Đồ Họa</h3>
                        <p>Ngành Thiết Kế tập trung vào sáng tạo giao diện và trải nghiệm người dùng thông qua các công cụ đồ họa và kỹ thuật số.</p>
                        <button class="close-btn" onclick="closeModal('modal-2')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-3">
                    <div class="image-container">
                        <img src="img/khdl.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Khoa Học Dữ Liệu</h3>
                    <p class="job-salary">Mức lương: $100k - $160k</p>
                    <p class="job-location">Địa điểm: Đà Nẵng</p>
                    <a href="#" class="details-btn" data-modal="modal-3">Giới Thiệu</a>
                </div>
                <div id="modal-3" class="modal">
                    <div class="modal-content">
                        <h3>Khoa Học Dữ Liệu</h3>
                        <p>Ngành Khoa Học Dữ Liệu tập trung vào phân tích và xử lý dữ liệu lớn để hỗ trợ ra quyết định kinh doanh.</p>
                        <button class="close-btn" onclick="closeModal('modal-3')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-4">
                    <div class="image-container">
                        <img src="img/anninhmang.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>An Ninh Mạng</h3>
                    <p class="job-salary">Mức lương: $90k - $150k</p>
                    <p class="job-location">Địa điểm: Hà Nội</p>
                    <a href="#" class="details-btn" data-modal="modal-4">Giới Thiệu</a>
                </div>
                <div id="modal-4" class="modal">
                    <div class="modal-content">
                        <h3>An Ninh Mạng</h3>
                        <p>Ngành An Ninh Mạng tập trung vào bảo vệ hệ thống và dữ liệu khỏi các mối đe dọa an ninh mạng.</p>
                        <button class="close-btn" onclick="closeModal('modal-4')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-5">
                    <div class="image-container">
                        <img src="img/mkt.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Marketing</h3>
                    <p class="job-salary">Mức lương: $90k - $150k</p>
                    <p class="job-location">Địa điểm: Hà Nội</p>
                    <a href="#" class="details-btn" data-modal="modal-5">Giới Thiệu</a>
                </div>
                <div id="modal-5" class="modal">
                    <div class="modal-content">
                        <h3>Marketing</h3>
                        <p>Ngành Marketing tập trung vào việc xây dựng chiến lược quảng bá sản phẩm và dịch vụ để thu hút khách hàng.</p>
                        <button class="close-btn" onclick="closeModal('modal-5')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-6">
                    <div class="image-container">
                        <img src="img/yte.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Y Tế</h3>
                    <p class="job-salary">Mức lương: $90k - $150k</p>
                    <p class="job-location">Địa điểm: Hà Nội</p>
                    <a href="#" class="details-btn" data-modal="modal-6">Giới Thiệu</a>
                </div>
                <div id="modal-6" class="modal">
                    <div class="modal-content">
                        <h3>Y Tế</h3>
                        <p>Ngành Y Tế tập trung vào chăm sóc sức khỏe, chẩn đoán và điều trị bệnh, cùng với nghiên cứu y học.</p>
                        <button class="close-btn" onclick="closeModal('modal-6')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-7">
                    <div class="image-container">
                        <img src="img/logistics.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Logistics</h3>
                    <p class="job-salary">Mức lương: $85k - $140k</p>
                    <p class="job-location">Địa điểm: Làm việc từ xa</p>
                    <a href="#" class="details-btn" data-modal="modal-7">Giới Thiệu</a>
                </div>
                <div id="modal-7" class="modal">
                    <div class="modal-content">
                        <h3>Logistics</h3>
                        <p>Ngành Logistics tập trung vào quản lý chuỗi cung ứng, vận chuyển và lưu kho hàng hóa.</p>
                        <button class="close-btn" onclick="closeModal('modal-7')">Đóng</button>
                    </div>
                </div>

                <div class="job-card" data-modal="modal-8">
                    <div class="image-container">
                        <img src="img/game.jpg" alt="Ngành" class="job-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Game</h3>
                    <p class="job-salary">Mức lương: $95k - $145k</p>
                    <p class="job-location">Địa điểm: Hà Nội</p>
                    <a href="#" class="details-btn" data-modal="modal-8">Giới Thiệu</a>
                </div>
                <div id="modal-8" class="modal">
                    <div class="modal-content">
                        <h3>Game</h3>
                        <p>Ngành Game tập trung vào thiết kế, phát triển và sản xuất trò chơi điện tử, bao gồm lập trình và thiết kế đồ họa.</p>
                        <button class="close-btn" onclick="closeModal('modal-8')">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Section -->
    <section class="company-section">
        <div class="container">
            <h2>Các Công Ty Hàng Đầu</h2>
            <div class="company-container">
                <div class="company-card">
                    <div class="image-container">
                        <img src="images/company.jpg" alt="Công ty" class="company-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Google</h3>
                    <p>Công Nghệ Thông Tin</p>
                </div>
                <div class="company-card">
                    <div class="image-container">
                        <img src="images/company.jpg" alt="Công ty" class="company-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Microsoft</h3>
                    <p>Phần mềm, AI</p>
                </div>
                <div class="company-card">
                    <div class="image-container">
                        <img src="images/company.jpg" alt="Công ty" class="company-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Apple</h3>
                    <p>Thiết bị tiêu dùng & AI</p>
                </div>
                <div class="company-card">
                    <div class="image-container">
                        <img src="images/company.jpg" alt="Công ty" class="company-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>Amazon</h3>
                    <p>Thương mại & Cloud</p>
                </div>
                <div class="company-card">
                    <div class="image-container">
                        <img src="images/company.jpg" alt="Công ty" class="company-image" onerror="this.src='https://via.placeholder.com/150';">
                    </div>
                    <h3>NVIDIA</h3>
                    <p>Chip & AI</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-us" id="guides">
        <div class="container">
            <h2>Tại Sao Nên Chọn Chúng Tôi?</h2>
            <div class="reasons-container">
                <div class="reason-card">
                    <i class="fas fa-briefcase"></i>
                    <h3>Cơ Hội Việc Làm Lớn</h3>
                    <p>Truy cập hơn 10.000 việc làm từ các ngành nghề đa dạng với số lượng cập nhật hàng ngày.</p>
                </div>
                <div class="reason-card">
                    <i class="fas fa-robot"></i>
                    <h3>Công Nghệ Tiên Tiến</h3>
                    <p>Sử dụng AI và tự động hóa để hỗ trợ ứng viên tìm việc nhanh chóng và chính xác.</p>
                </div>
                <div class="reason-card">
                    <i class="fas fa-hands-helping"></i>
                    <h3>Hỗ Trợ Ứng Viên</h3>
                    <p>Cung cấp hướng dẫn phỏng vấn, tối ưu CV, và tư vấn nghề nghiệp miễn phí.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2>Liên Hệ</h2>
            <div class="footer-content">
                <div class="footer-left">
                    <h4>Liên Hệ</h4>
                    <p>SĐT: +84 963176945</p>
                    <p>Địa chỉ: BD, HCM</p>
                </div>
                <div class="footer-center">
                    <h4>Liên Hệ Với Chúng Tôi</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-right">
                    <h4>Liên Kết Nhanh</h4>
                    <div class="quick-links">
                        <a href="#home">Trang Chủ</a>
                        <a href="#industries">Công Việc</a>
                        <a href="#guides">Cẩm Nang</a>
                        <a href="#top-cv">Top CV</a>
                        <a href="#contact">Liên Hệ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="js/script.js?v=8"></script>
</body>
</html>

<?php $conn->close(); ?>