<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "petfolio";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 폼 데이터 받기
$post_id = $_POST['post_id'];
$content = $_POST['content'];
$username = $_SESSION['user_name'];
 // 현재 로그인한 사용자의 닉네임

// 댓글 저장 쿼리
$sql = "INSERT INTO comments (post_id, username, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $post_id, $username, $content);
$stmt->execute();

// 페이지 리디렉션
header("Location: ../pf/pf_in.php?post_id=" . $post_id);
exit();
?>
