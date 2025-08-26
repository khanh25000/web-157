<?php
require 'db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = strtolower(trim($_POST['role'])); // Lấy vai trò từ form

// Kiểm tra vai trò hợp lệ
if (!in_array($role, ['admin', 'user'])) {
    header("Location: register.php?error=" . urlencode("Vai trò không hợp lệ!"));
    exit();
}

$stmt = $conn->prepare("INSERT INTO users (username, password, email, phone, role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $password, $email, $phone, $role);
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: index.php"); // Chuyển về trang đăng nhập
    exit();
} else {
    $stmt->close();
    $conn->close();
    header("Location: register.php?error=" . urlencode($conn->error));
    exit();
}
?>