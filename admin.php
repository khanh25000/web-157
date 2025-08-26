<?php
session_start();
require_once 'db.php'; // Sử dụng require_once để tránh include nhiều lần

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Xử lý thêm ngành
if (isset($_POST['add'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $salary = $conn->real_escape_string($_POST['salary']);
    $work_time = $conn->real_escape_string($_POST['work_time']);
    $location = $conn->real_escape_string($_POST['location']);

    $sql = "INSERT INTO industries (name, description, company_name, salary, work_time, location) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Lỗi prepare thêm ngành: " . $conn->error);
        echo "<script>alert('Lỗi hệ thống, vui lòng thử lại sau!');</script>";
    } else {
        $stmt->bind_param("ssssss", $name, $description, $company_name, $salary, $work_time, $location);
        if ($stmt->execute()) {
            echo "<script>alert('Thêm ngành thành công!'); window.location.href = 'admin.php';</script>";
        } else {
            error_log("Lỗi thêm ngành: " . $stmt->error);
            echo "<script>alert('Lỗi thêm ngành: " . addslashes($stmt->error) . "');</script>";
        }
        $stmt->close();
    }
}

// Xử lý xóa ngành
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM industries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Lỗi prepare xóa ngành: " . $conn->error);
        echo "<script>alert('Lỗi hệ thống, vui lòng thử lại sau!');</script>";
    } else {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Xóa ngành thành công!'); window.location.href = 'admin.php';</script>";
        } else {
            error_log("Lỗi xóa ngành: " . $stmt->error);
            echo "<script>alert('Lỗi xóa ngành: " . addslashes($stmt->error) . "');</script>";
        }
        $stmt->close();
    }
}

// Xử lý sửa ngành
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $salary = $conn->real_escape_string($_POST['salary']);
    $work_time = $conn->real_escape_string($_POST['work_time']);
    $location = $conn->real_escape_string($_POST['location']);

    $sql = "UPDATE industries SET name = ?, description = ?, company_name = ?, salary = ?, work_time = ?, location = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Lỗi prepare sửa ngành: " . $conn->error);
        echo "<script>alert('Lỗi hệ thống, vui lòng thử lại sau!');</script>";
    } else {
        $stmt->bind_param("ssssssi", $name, $description, $company_name, $salary, $work_time, $location, $id);
        if ($stmt->execute()) {
            echo "<script>alert('Sửa ngành thành công!'); window.location.href = 'admin.php';</script>";
        } else {
            error_log("Lỗi sửa ngành: " . $stmt->error);
            echo "<script>alert('Lỗi sửa ngành: " . addslashes($stmt->error) . "');</script>";
        }
        $stmt->close();
    }
}

// Lấy danh sách ngành
$sql = "SELECT * FROM industries ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result === false) {
    error_log("Lỗi truy vấn danh sách ngành: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang Admin - Quản Lý Ngành Nghề</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/styless.css?v=6" />
</head>
<body>
  <!-- Navigation -->
  <header>
    <nav class="navbar">
      <img src="images/logo.png" alt="Logo" class="logo-img" onerror="this.src='https://via.placeholder.com/40';">
      <ul class="nav-menu">
        <li><a href="#home" class="nav-link active">Trang Chủ</a></li>
        <li><a href="#industries" class="nav-link">Quản Lý Ngành</a></li>
        <li><a href="logout.php" class="logout-btn">Đăng Xuất</a></li>
      </ul>
    </nav>
  </header>

  <!-- Particle Background -->
  <div id="particles-js"></div>

  <!-- Main Content -->
  <main>
    <section id="home" class="hero">
      <div class="container">
        <h1>Quản Lý Ngành Nghề</h1>
        <p class="hero-subtitle">Quản lý thông tin ngành nghề một cách dễ dàng và hiệu quả</p>
      </div>
    </section>

    <section id="industries" class="section">
      <div class="container">
        <!-- Form Thêm Ngành -->
        <div class="card add-industry">
          <h2>Thêm Ngành Mới</h2>
          <form method="POST" class="form-add">
            <div class="form-group">
              <input type="text" name="name" placeholder="Tên ngành nghề" required class="form-input" maxlength="50">
            </div>
            <div class="form-group">
              <input type="text" name="company_name" placeholder="Tên công ty" required class="form-input" maxlength="50">
            </div>
            <div class="form-group">
              <input type="text" name="salary" placeholder="Mức lương (ví dụ: $80k - $160k)" required class="form-input" maxlength="20">
            </div>
            <div class="form-group">
              <input type="text" name="work_time" placeholder="Thời gian làm (ví dụ: Full-time)" required class="form-input" maxlength="20">
            </div>
            <div class="form-group">
              <input type="text" name="location" placeholder="Địa điểm" required class="form-input" maxlength="50">
            </div>
            <div class="form-group">
              <textarea name="description" placeholder="Mô tả" class="form-input" rows="3" maxlength="200"></textarea>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Thêm Ngành</button>
          </form>
        </div>

        <!-- Danh Sách Ngành -->
        <h2 class="section-title">Danh Sách Ngành</h2>
        <div class="job-grid">
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="card job-card">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><strong>Công ty:</strong> <?php echo htmlspecialchars($row['company_name']); ?></p>
                <p><strong>Mức lương:</strong> <?php echo htmlspecialchars($row['salary']); ?></p>
                <p><strong>Thời gian:</strong> <?php echo htmlspecialchars($row['work_time']); ?></p>
                <p><strong>Địa điểm:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                <form method="POST" class="form-update">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <div class="form-group">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required class="form-input" maxlength="50">
                  </div>
                  <div class="form-group">
                    <input type="text" name="company_name" value="<?php echo htmlspecialchars($row['company_name']); ?>" required class="form-input" maxlength="50">
                  </div>
                  <div class="form-group">
                    <input type="text" name="salary" value="<?php echo htmlspecialchars($row['salary']); ?>" required class="form-input" maxlength="20">
                  </div>
                  <div class="form-group">
                    <input type="text" name="work_time" value="<?php echo htmlspecialchars($row['work_time']); ?>" required class="form-input" maxlength="20">
                  </div>
                  <div class="form-group">
                    <input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required class="form-input" maxlength="50">
                  </div>
                  <div class="form-group">
                    <textarea name="description" class="form-input" rows="3" maxlength="200"><?php echo htmlspecialchars($row['description']); ?></textarea>
                  </div>
                  <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Sửa</button>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Xác nhận xóa?');">Xóa</a>
                  </div>
                </form>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="no-data">Không có ngành nào để hiển thị.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="js/scripts.js?v=5"></script>
</body>
</html>

<?php $conn->close(); ?>