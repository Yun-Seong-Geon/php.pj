<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../topbar/TopBar.css">
</head>
<body>
    <div class="Top_bar">
        <!-- 탑바 내용 -->
        <a href="../main/main.php">
            <img class="logo" src="../img/pf .png" alt="none">
        </a>
        
        <div class="TopBar_middle">
            <a href="../pf/pf.php">PF</a>
            <a href="../board/board.php">게시판</a>
            <a href="../notice/notice.php">공지사항</a>
            <a href="../ai/ai.php">AI</a>
        </div>

        <div class="TopBar_right">
            <?php if (isset($_SESSION['user_name'])): ?>
                <a class="user-greeting"><?php echo htmlspecialchars($_SESSION['user_name']); ?>님</a>
                <!-- 로그아웃 버튼 -->
                <form action="../login/logout.php" method="post">
                    <button type="submit" name="logout" class = 'TopBar_right_button' >로그아웃</button>
                </form>
            <?php else: ?>
                <a href="../login/login.php" class="login-link">로그인</a>
                <a href="../signup/signup.php" class="signup-link">회원가입</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
