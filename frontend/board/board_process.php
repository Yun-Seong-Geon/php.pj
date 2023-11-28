<?php
session_start();
include '../topbar/topbar.php';

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "petfolio";

// 데이터베이스 연결
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 폼 데이터 받기 및 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $author = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '익명';

    // 게시글 저장 쿼리 준비
    $sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";

    // 준비된 명령문 사용
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("쿼리 준비 실패: " . $conn->error);
    }

    $stmt->bind_param("sss", $title, $content, $author);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // 성공적으로 게시글 등록 후, 게시글 목록 페이지로 리디렉션
        header("Location: ../board/board.php");
        exit();
    } else {
        echo "오류: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
