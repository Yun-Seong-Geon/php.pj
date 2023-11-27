<?php
include '../topbar/topbar.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; // 데이터베이스 사용자 이름
$password = ""; // 데이터베이스 비밀번호
$dbname = "petfolio"; // 데이터베이스 이름

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 게시글 조회 쿼리
$sql = "SELECT id, title, author, created_at, views FROM notices ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notice.css">
    
</head>
<body>
    <h1 class="notice_text">공지사항</h1>
    <div class="notice_container">
        <div class="search_container">
            <select class="select_box">
                <option>제목</option>
                <option>글쓴이</option>
            </select>

            <input class="select_box" type="text" name="search_input" placeholder="검색어를 입력하세요" style="width: 600px;"> <!--TODO:검색 input box php 연결해야함-->

            <button type="button" class="search-button">
                <img src="../img/검색 아이콘.png" alt="검색" class="search-icon"> <!--TODO:버튼 누르면 검색-->
            </button>

        </div>

            <div class="paging">
                <a href="첫페이지로 이동" class="bt">첫번째 페이지</a>
                <a href="1페이지" class="num on">1</a> <!--TODO:동적으로 받아야함-->
                <a href="2페이지" class="num">2</a> <!--TODO:동적으로 받아야함-->
                <a href="마지막 페이지로 이동" class="bt">마지막 페이지</a>
            </div>
        </div>
    </div>

    
</body>
</html>