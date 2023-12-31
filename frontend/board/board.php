<?php
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

// 현재 페이지 번호 확인
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 5; // 페이지당 게시글 수

// 전체 게시글 수 조회
$totalSql = "SELECT COUNT(*) AS total FROM posts";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $perPage);

// 페이지에 해당하는 게시글 조회
$start = ($page - 1) * $perPage;
$sql = "SELECT id, title, author, created_at, views FROM posts ORDER BY created_at DESC LIMIT $start, $perPage";
$result = $conn->query($sql);
$start = ($page - 1) * $perPage;
$sql = "SELECT id, title, author, created_at, views FROM posts ORDER BY created_at DESC LIMIT $start, $perPage";
$result = $conn->query($sql);

// 순번 계산
$seqNum = ($page - 1) * $perPage + 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="board.css">
    
</head>
<body>
    <h1 class="notice_text">게시판</h1>
    <div class="notice_container">
    <form action="../board/board_search.php" method="get" class="search_container">
            <select name="search_type" class="select_box">
                <option value="title">제목</option>
            </select>

            <input class="select_box" type="text" name="search_input" placeholder="검색어를 입력하세요" style="width: 600px;">

            <button type="submit" class="search-button">
                <img src="../img/검색 아이콘.png" alt="검색" class="search-icon">
            </button>
        </form>

        <div class="board_list_wrap">
            <table class="board_list">
                <thead>
                    <tr>
                        <th>순번</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>작성일</th>
                        <th>조회수</thq>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $seqNum++ . "</td>";
                            echo "<td class='tit'><a href='../board/board_in.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["title"]) . "</a></td>";
                            echo "<td>". $row['author']. " </td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td>" . $row["views"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                    }
                ?>
                </tbody>
            </table>


    
            <div class="paging">
                <?php if ($page > 1): ?>
                    <a href="?page=1" class="bt">첫 페이지</a>
                    <a href="?page=<?php echo $page - 1; ?>" class="bt">이전</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class= "num <?php echo ($i == $page) ? 'on' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="bt">다음</a>
                    <a href="?page=<?php echo $totalPages; ?>" class="bt">마지막 페이지</a>
                <?php endif; ?>
            </div>
            <div class="WriteButton_container">

                <button onclick="checkLoginAndRedirect()" class="board_write">글쓰기</button>
                <script>
                function checkLoginAndRedirect() {
                    <?php if (isset($_SESSION['user_id'])): ?>
                        // 로그인 상태인 경우, board_write.php로 리디렉션
                        window.location.href = '../board/board_write.php';
                    <?php else: ?>
                        // 로그인 상태가 아닌 경우, 로그인 페이지로 리디렉션
                        window.location.href = '../login/login.php';
                    <?php endif; ?>
                }
                </script>

            </div>
        </div>
    </div>

    
</body>
</html>

