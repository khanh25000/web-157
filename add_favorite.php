<?php
session_start();
require 'db.php';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'user' && isset($_POST['industry_id'])) {
    $user_id = $_SESSION['user_id'];
    $industry_id = intval($_POST['industry_id']);

    $sql = "INSERT INTO favorites (user_id, industry_id) VALUES ($user_id, $industry_id)";
    $conn->query($sql);
}

$conn->close();
header("Location: home.php");
exit();
?>