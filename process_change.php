<?php
require 'db.php';

$username = $_POST['username'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if ($newPassword !== $confirmPassword) {
    header("Location: change_password.php?error=mismatch");
    exit();
}

$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->bind_param("ss", $newPasswordHash, $username);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: index.php?changed=1");
exit();
?>
