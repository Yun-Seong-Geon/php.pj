<?php
session_start();
include '../topbar/topbar.php';

// 데이터베이스 연결 설정
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "petfolio";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 게시물 ID 가져오기
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;
$updateViewsSql = "UPDATE pf SET views = views + 1 WHERE id = $post_id";
$conn->query($updateViewsSql);

// 게시물 데이터 조회
$sql = "SELECT * FROM pf WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    // 데이터 추출
    $imagePath = $row['image_path'];
    $content = $row['content'];
    $author = $row['author'];
    $views = $row['views'];
    // 추가 필드가 있다면 여기서 추출
} else {
    echo "게시물을 찾을 수 없습니다.";
    exit();
}
// 댓글 데이터 조회
$commentsSql = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
$commentsStmt = $conn->prepare($commentsSql);
$commentsStmt->bind_param("i", $post_id);
$commentsStmt->execute();
$commentsResult = $commentsStmt->get_result();
$comments = [];
while ($comment = $commentsResult->fetch_assoc()) {
    $comments[] = $comment;
}
$commentsStmt->close();


$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pf_InDetail.css">
    <link rel="stylesheet" href="pf_in.css">
</head>

<body>
    <section id="container">
        <div id="main_container">

            <section class="b_inner">

                <div class="contents_box" style="margin-top: 150px;">

                    <article class="contents">

                    <div class="img_section">
                        <div class="trans_inner">
                            <div><img src="<?php echo $imagePath; ?>" alt=""></div>
                        </div>
                        <a class="content-text"><?php echo $content; ?></a>
                    </div>

                        <div class="detail--right_box">

                            <header class="top">
                                <div class="user_container">
                                    <div class="user_name">
                                    <div class="nick_name"><?php echo $author; ?></div>
                                    <form  id = "delete_pf"action="../pf/pf_in_process.php" method="post">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                        <a href="#" name = 'delete_post'onclick="deletePost()" class="delete_text">게시물 삭제</a><!--TODO:동적으로 받아야함 -->
                                        <script>
                                            function deletePost() {
                                                document.getElementById('delete_pf').submit()
                                                alert('게시물이 삭제되었습니다.');
                                            }
                                        </script>
                                    </form>
                                    </div>
                                </div>
                            </header>

                            <section id="container">

                                <section class="scroll_section">
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="admin_container">
                                            <div class="admin"></div>
                                            <div class="comment">
                                                <span class="user_id"><?php echo htmlspecialchars($comment['username']); ?></span>
                                                <?php echo htmlspecialchars($comment['content']); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php if (empty($comments)): ?>
                                        <p>아직 댓글이 없습니다.</p>
                                    <?php endif; ?>
                                </section>


                            <div class="bottom_icons">
                                <div class="left_icons">
                                    <div class="heart_btn">
                                        <div class="sprite_heart_icon_outline" data-name="heartbeat"></div>
                                    </div>
                                    <div>
                                        <div class="sprite_bubble_icon"></div>
                                    </div>
                                    <div>
                                        <div class="sprite_share_icon" data-name="share"></div>
                                    </div>
                                </div>

                                <div class="right_icon">
                                    <div class="sprite_bookmark_outline" data-name="book-mark"></div>
                                </div>
                            </div>

                            <div class="count_likes">
                                조회수
                                <span class="count"><?php echo "$views" ?></span>
                                회
                            </div>

                            <form id="commentForm" action="../pf/pf_comment_process.php" method="post">
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>"> <!-- 게시물 ID -->
                                <div class="commit_field">
                                    <input type= "text" class = "input_margin" placeholder= "댓글달기.." name= "content">
                                    </div>
                                    <div class="upload_btn" onclick="document.getElementById('commentForm').submit();">게시</div>
                                    
                            </form>
                        </div>
                    </article>
                </div>
            </section>

        </div>


        <div class="del_pop">
            <div class="btn_box">
                <div class="del">삭제</div>
                <div class="cancel">취소</div>
            </div>
        </div>

    </section>

</body>

</html>