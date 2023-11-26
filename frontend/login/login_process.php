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

// SQL 쿼리 준비
$sql = "SELECT * FROM users WHERE username = ?"; // 비밀번호는 조회하지 않습니다.

// 준비된 명령문 사용
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId); // 's'는 파라미터가 문자열임을 의미
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // password_verify를 사용하여 입력된 비밀번호와 해시된 비밀번호를 비교
    if (password_verify($userPw, $row['password_hash'])) {
        // 로그인 성공
        echo "로그인 성공";
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
