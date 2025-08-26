DROP DATABASE IF EXISTS users;
CREATE DATABASE users CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE users;
-- Tạo bảng users (dành cho đăng ký và đăng nhập)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID người dùng tự tăng',
    username VARCHAR(50) UNIQUE NOT NULL COMMENT 'Tên đăng nhập, duy nhất',
    password VARCHAR(255) NOT NULL COMMENT 'Mật khẩu đã hash',
    email VARCHAR(100) COMMENT 'Email người dùng',
    phone VARCHAR(10) COMMENT 'Số điện thoại (khớp maxlength=10)',
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user' COMMENT 'Vai trò người dùng: admin hoặc user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE industries (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID ngành nghề tự tăng',
    name VARCHAR(100) NOT NULL COMMENT 'Tên ngành nghề',
    description TEXT COMMENT 'Mô tả ngành nghề',
    company_name VARCHAR(100) NOT NULL COMMENT 'Tên công ty',
    salary VARCHAR(50) NOT NULL COMMENT 'Mức lương (ví dụ: $80k - $160k)',
    work_time VARCHAR(50) NOT NULL COMMENT 'Thời gian làm (ví dụ: Full-time)',
    location VARCHAR(100) NOT NULL COMMENT 'Địa điểm (ví dụ: TP. Hồ Chí Minh)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID yêu thích tự tăng',
    user_id INT NOT NULL COMMENT 'ID người dùng từ bảng users',
    industry_id INT NOT NULL COMMENT 'ID ngành từ bảng industries',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian thêm yêu thích',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (industry_id) REFERENCES industries(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID ứng tuyển tự tăng',
    user_id INT NOT NULL COMMENT 'ID người dùng từ bảng users',
    industry_id INT NOT NULL COMMENT 'ID ngành từ bảng industries',
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian ứng tuyển',
    status VARCHAR(50) DEFAULT 'pending' COMMENT 'Trạng thái ứng tuyển (pending, accepted, rejected)',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (industry_id) REFERENCES industries(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (username, password, email, phone, role) VALUES
('testadmin', '$2y$10$6fN6jQz1z7z9X9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9', 'admin@example.com', '0123456789', 'admin'),
('testuser', '$2y$10$6fN6jQz1z7z9X9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9z9', 'user@example.com', '0987654321', 'user');

INSERT INTO industries (name, description, company_name, salary, work_time, location) VALUES
('Công Nghệ Thông Tin', 'Ngành liên quan đến phần mềm, lập trình.', 'Google', '$80k - $160k', 'Full-time', 'Làm việc từ xa'),
('Thiết Kế Đồ Họa', 'Ngành sáng tạo giao diện người dùng.', 'Apple', '$70k - $120k', 'Part-time', 'TP. Hồ Chí Minh'),
('Khoa Học Dữ Liệu', 'Phân tích dữ liệu lớn.', 'Microsoft', '$100k - $160k', 'Full-time', 'Đà Nẵng'),
('An Ninh Mạng', 'Bảo vệ hệ thống khỏi tấn công.', 'Amazon', '$90k - $150k', 'Full-time', 'Hà Nội'),
('Marketing', 'Chiến lược quảng bá sản phẩm.', 'NVIDIA', '$90k - $150k', 'Full-time', 'Hà Nội'),
('Y Tế', 'Chăm sóc sức khỏe và nghiên cứu y học.', 'MedCorp', '$90k - $150k', 'Full-time', 'Hà Nội'),
('Logistics', 'Quản lý chuỗi cung ứng.', 'LogiTech', '$85k - $140k', 'Full-time', 'Làm việc từ xa'),
('Game', 'Thiết kế và phát triển trò chơi điện tử.', 'GameDev', '$95k - $145k', 'Full-time', 'Hà Nội');

CREATE INDEX idx_username ON users(username);
CREATE INDEX idx_industry_name ON industries(name);
CREATE INDEX idx_fav_user ON favorites(user_id, industry_id);
CREATE INDEX idx_app_user ON applications(user_id, industry_id);

INSERT INTO favorites (user_id, industry_id) VALUES
(1, 1), 
(2, 2); 