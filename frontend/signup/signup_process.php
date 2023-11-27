<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// POST 요청으로 받은 데이터를 변수에 할당
$id = isset($_POST['id']) ? $_POST['id'] : '';
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';
$repass = isset($_POST['repass']) ? $_POST['repass'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';

// 필수 필드 확인
if (empty($id) || empty($pw) || empty($repass) || empty($name)) {
    echo "<script>alert('모든 필드를 입력해주세요.'); window.history.back();</script>";
    exit();
}

// 비밀번호 일치 확인
if ($pw !== $repass) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); window.history.back();</script>";
    exit();
}

// 비밀번호 해시 생성
$passwordHash = password_hash($pw, PASSWORD_DEFAULT);

// SQL 쿼리 준비
$sql = "INSERT INTO users (username, password_hash, name, role) VALUES (?, ?, ?, ?)";
$role = 'user';
// 준비된 명령문 사용
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $id, $passwordHash, $name, $role);
$stmt->execute();
$role = 'user';
if ($stmt->affected_rows > 0) {
    echo "회원가입 성공";
    // 로그인 페이지나 메인 페이지로 리디렉션
    header("Location: ../main/main.php");
} else {
    echo "오류: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
