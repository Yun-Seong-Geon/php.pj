<?php
session_start();
include '../topbar/topbar.php';
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

// 오류 메시지를 저장할 변수
$errorMsg = "";

// 이미지 및 내용 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $targetDir = "pf_image/";
    
    // 파일 확장자 추출
    $fileType = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

    // 안전한 파일 이름 생성 (현재 시간 및 랜덤 숫자 사용)
    $fileName = time() . rand(0, 9999) . "." . $fileType;

    $targetFilePath = $targetDir . $fileName;

    // 파일 업로드
    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $username = $_SESSION['user_name'];
        $sql = "INSERT INTO pf (image_path, content, author) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $targetFilePath, $content,$username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $errorMsg = "게시글이 성공적으로 등록되었습니다.";
        } 
        else {
            $errorMsg = "오류: " . $conn->error;
        }
        $stmt->close();
    } 
    else {
        $errorMsg = "이미지 업로드에 실패했습니다.";
    }
} 
else {
    $errorMsg = "이미지를 선택해주세요.";
}
