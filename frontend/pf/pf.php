<?php
session_start();
include '../topbar/topbar.php';

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "petfolio";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 1; // 페이지당 게시글 수

// 전체 게시글 수 조회
$totalSql = "SELECT COUNT(*) AS total FROM pf";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $perPage);

// 페이지에 해당하는 게시글 조회
$start = ($page - 1) * $perPage;
$sql = "SELECT * FROM pf ORDER BY created_at DESC LIMIT $start, $perPage";
$results = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_pf.css">
    <link rel="stylesheet" href="pf.css">
</head>

<body>

    <div class="contents_box">
        <div class="pet_folio">
            <p>Pet Folio</p>
        </div>
            <?php
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $title = htmlspecialchars($row['title']);
            $imagePath = $row['image_path'];
            $likes = $row['views']; // 예시 데이터 필드
            $comments = $row['content']; // 예시 데이터 필드
            ?>

            <article class="contents">
                <!-- 게시물 내용 표시 -->
                <header class="top">
                    <div class="user_container">
                        <div class="user_name">
                            <div class="nick_name m_text"><?php echo $title; ?></div>
                        </div>
                    </div>
                </header>

                <div class="img_section">
                    <div class="trans_inner">
                        <div><img src="<?php echo $imagePath; ?>" alt="Visual"></div>
                    </div>
                </div>

                <!-- 기타 섹션 (아이콘, 조회수, 댓글수) -->

                <div class="likes m_text">
                    조회수 <span><?php echo $likes; ?></span>
                    &nbsp;&nbsp;&nbsp;댓글수 <span><?php echo $comments; ?></span>
                </div>

                <div class="comment_field">
                    <a href="../pf/pf_in.php?post_id=<?php echo $row['id']; ?>" class="upload_btn m_text">자세히보기</a>
                </div>
            </article>
            <?php
        }
    } else {
        echo "<p class='pet_folio'>게시글이 없습니다. 글을 작성해주세요.</p>";
    }
    ?>


        <div class="WriteButton_container">
            <button onclick="checkLoginAndRedirect()" class="board_write">글쓰기</button><!--TODO 세션없을시 로그인으로, pf_write로 다이렉션-->
            <script>
                function checkLoginAndRedirect() {
                    <?php if (isset($_SESSION['user_id'])): ?>
                        // 로그인 상태인 경우, board_write.php로 리디렉션
                        window.location.href = "../pf/pf_write.php" ;
                    <?php else: ?>
                        // 로그인 상태가 아닌 경우, 로그인 페이지로 리디렉션
                        window.location.href = '../login/login.php';
                    <?php endif; ?>
                }
                </script>
        </div>
                
        <div class="paging">
                <?php if ($page > 1): ?>
                    <a href="?page=1" class="num">첫 페이지</a>
                    <a href="?page=<?php echo $page - 1; ?>" class="num">이전</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="num <?php echo ($i == $page) ? 'on' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="num">다음</a>
                    <a href="?page=<?php echo $totalPages; ?>" class="num">마지막 페이지</a>
                <?php endif; ?>
            </div>
    </div>
</body>
</html>