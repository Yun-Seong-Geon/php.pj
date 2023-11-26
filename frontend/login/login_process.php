<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// 폼 데이터 받기
$userId = $_POST['id'];
$userPw = $_POST['pw'];

// 모든 필드가 채워졌는지 확인
if (empty($userId) || empty($userPw)) {
    // 필드가 비어있으면 사용자에게 메시지 출력하고 스크립트 실행 중단
    echo "<script>alert('모든 필드를 입력해주세요.'); window.history.back();</script>";
    exit();
}

// SQL 쿼리 준비
$sql = "SELECT * FROM users WHERE username = ?";

// 준비된 명령문 사용
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // password_verify를 사용하여 입력된 비밀번호와 해시된 비밀번호를 비교
    if (password_verify($userPw, $row['password_hash'])) {
        // 로그인 성공
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name']; // 'name' 필드를 데이터베이스에서 가져옵니다.

        header("Location: ../main/main.php");
        exit();
    }
}

// 로그인 실패
echo "로그인 실패";
header("Location: login.php?error=invalid_credentials");
exit();

$stmt->close();
$conn->close();
?>
