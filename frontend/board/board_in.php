<?php
session_start();
include '../topbar/topbar.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petfolio";
$user_nickname = $_SESSION['user_name'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// URL에서 게시글 ID 가져오기
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateViewsSql = "UPDATE posts SET views = views + 1 WHERE id = $post_id";
$conn->query($updateViewsSql);
// 게시글 상세 정보 조회
$sql = "SELECT title, author, created_at, views, content FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $date = $row['created_at'];
    $views = $row['views'];
    $content = nl2br(htmlspecialchars($row['content']));
} else {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="board_in.css">

</head>

<body>
    <h1 class="notice_text">게시판</h1>
    <div class="notice_container">
        <div class="top-containter">
        <h2 class="top-h2" style="margin-left: 20px;" ><?php echo $title; ?></h2>
            <div class="top-h5">
                <h5 class="top-text" style="display: inline;">등록인</h5>
                <h5 style="display: inline;"><?php echo $author; ?></h5>
                <h5 class="top-text" style="display: inline;">글번호</h5>
                <h5 style="display: inline;"><?php echo $post_id; ?></h5>
                <h5 class="top-text" style="display: inline;">작성일</h5>
                <h5 style="display: inline;"><?php echo $date; ?></h5>
                <h5 class="top-text" style="display: inline;">조회</h5>
                <h5 style="display: inline;"><?php echo $views; ?></h5>
            </div>
        </div>

        <div class="text-container">
            <div class="text_gap">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="UpdateButton_container">
        <?php
            if ($user_nickname == $author) {
                // 사용자가 게시물의 작성자인 경우 수정 링크 표시
                echo '
                        <a href="../board/board_update.php? id= '.$post_id. '" class="board_update">수정하기</a>';
                } else {
                }?>
        </div>

        <div class="next-page">
            <a href="이전 글로 이동" class="bt">이전글</a><!--TODO:php 연결-->
            <a href="../board/board.php" class="bt" style="padding: 10px 30px;">목록</a><!--TODO:php 연결-->
            <a href="다음 글로 이동" class="bt">다음글</a><!--TODO:php 연결-->
        </div>
    </div>


</body>

</html>