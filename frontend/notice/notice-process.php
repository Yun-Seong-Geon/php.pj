<?php
session_start();

// 관리자 확인
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("관리자만 접근 가능합니다.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petfolio";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

?>