<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "users";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
