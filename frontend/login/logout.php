<?php
session_start();
// 로그아웃 처리
if (isset($_POST['logout'])) {
    // 세션 변수 제거
    session_unset();

    // 세션 파괴
    session_destroy();

    // 로그인 페이지로 리디렉션
    header("Location: ../login/login.php");
    exit();
}
?>