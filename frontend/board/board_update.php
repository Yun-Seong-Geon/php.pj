<?php
include '../topbar/topbar.php';

// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petfolio";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// URL에서 게시글 ID 가져오기
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 게시글 정보 조회
$sql = "SELECT title, content, author FROM posts WHERE id = $post_id";
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
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="board_update.css">
</head>

<body>
    <h1 class="notice_text">게시글 수정</h1>
    <div class="notice_container">
        <div class="board_wrap">
        <!--<button  name = 'delete_post' class="delete_text">게시물 삭제</button>--><!--TODO 게시판 삭제 버튼 추가함-->
            <form action="../board/board_update_process.php" method="post">
                <div class="title_containter">
                    <label for="title" class="font_a">제목</label> 
                    <input id="title" name="title" class="title_input" type="text" placeholder="제목을 입력하세요." value="<?php echo $title; ?>" required>
                </div>

                <div class="name_container">
                    <label for="name" class="font_a" style="margin-right: 26px;">이름</label>
                    <a><?php echo $author; ?></a>
                </div>

                <div class="content_container">
                    <label for="content" class="font_a">내용</label>
                </div>
                <textarea id="content" name="content" class="text_box" rows="4" required><?php echo $content; ?></textarea>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class = "bt_container">
                    <button type="submit" class="submit_button">수정</button>
                </div>
            </form>
            <form id="delete_board" class="deletePost" action="../board/board_delete.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="bt_container1">
                    <!-- 삭제 버튼 클릭 시 deletePost() 함수 호출 -->
                    <button class="submit_button1" type="button" onclick="deletePost()">삭제</button>
                </div>
        </form>
        <script>
                function deletePost() {
                    var result = confirm('게시물을 삭제하시겠습니까?');
                    if (result) {
                        // form을 직접 submit
                        document.getElementById('delete_board').submit();
                    }
                }
            </script>
        </div>
    </div>
</body>

</html>

</html>