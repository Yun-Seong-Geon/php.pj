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
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 10; // 페이지당 게시글 수

$searchInput = isset($_GET['search_input']) ? $_GET['search_input'] : '';
// 검색 쿼리 실행 및 순번 계산
if (!empty($searchInput)) {
    $searchInput = $conn->real_escape_string($searchInput);

    // 전체 검색 결과 수 확인
    $totalSql = "SELECT COUNT(*) AS total FROM notices WHERE title LIKE '%$searchInput%'";
    $totalResult = $conn->query($totalSql);
    $totalRow = $totalResult->fetch_assoc();
    $totalPages = ceil($totalRow['total'] / $perPage);

    // 페이지에 해당하는 검색 결과 조회
    $start = ($page - 1) * $perPage;
    $sql = "SELECT id, title, author, created_at, views FROM notices WHERE title LIKE '%$searchInput%' ORDER BY created_at DESC LIMIT $start, $perPage";
    $result = $conn->query($sql);

    // 순번 계산
    $seqNum = ($page - 1) * $perPage + 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notice.css">
</head>
<body>
    <h1 class="notice_text">공지사항 검색 결과</h1>
    <div class="notice_container">
        <form action="notice_search.php" method="get" class="search_container">
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
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (!empty($searchInput)) {
                    $searchInput = $conn->real_escape_string($searchInput);
                    $sql = "SELECT id, title, author, created_at, views FROM notices WHERE title LIKE '%$searchInput%' ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $seqNum++ . "</td>";
                            echo "<td class='tit'><a href='../notice/notice_in.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["title"]) . "</a></td>";
                            echo "<td> 관리자 </td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td>" . $row["views"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>해당 단어의 검색 결과가 없습니다.</td></tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
<?php
    $conn->close();
?>
