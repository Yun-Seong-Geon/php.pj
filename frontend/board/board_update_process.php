<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petfolio";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// POST 데이터 검증 및 할당
$title = isset($_POST['title']) ? $_POST['title'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0; // 게시글 ID

// 입력 데이터의 유효성 검사
if (empty($title) || empty($content)) {
    echo "제목과 내용을 모두 입력해야 합니다.";
    exit;
}

// SQL 쿼리 준비
$sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";

// 쿼리 준비
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("쿼리 준비 실패: " . $conn->error);
}

// 변수 바인딩
$stmt->bind_param("ssi", $title, $content, $post_id);

// 쿼리 실행
if ($stmt->execute()) {

    header("Location: ../board/board.php");
    exit();
    // 여기서 수정된 게시글 보기 페이지나 게시판 목록으로 리디렉션할 수 있습니다.
} else {
    echo "게시글 수정 실패: " . $stmt->error;
}

// 연결 종료
$stmt->close();
$conn->close();
?>
