<?php
include '../topbar/topbar.php';

session_start();

// 로그인한 사용자의 닉네임 가져오기
$user_nickname = $_SESSION['user_name'];

?>

?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="board_write.css">
</head>

<body>
    <h1 class="notice_text">게시글 쓰기</h1>
    <div class="notice_container">
        <div class="board_wrap">
            <form action="../board/board_process.php" method="post"> <!-- PHP 스크립트 파일로 연결 -->
                <div class="title_containter">
                    <label for="title" class="font_a">제목</label>
                    <input id="title" name="title" class="title_input" type="text" placeholder="제목을 입력하세요." required>
                </div>

                <div class="name_container">
                    <label for="name" class="font_a" style="margin-right: 26px;">이름</label>
                    <a><?php echo htmlspecialchars($user_nickname); ?></a>
                </div>

                <div class="content_container">
                    <label for="content" class="font_a">내용</label>
                </div>
                <textarea id="content" name="content" class="text_box" rows="4" required></textarea>
                
                <button type="submit" class="submit_button">글쓰기</button>
            </form>
        </div>
    </div>
</body>
</html>
