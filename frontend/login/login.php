
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="Login.js"></script> 
</head>

<body>

<?php
    if (isset($_GET['error'])) {
        echo "<script>alert('로그인 실패: 아이디 또는 비밀번호가 올바르지 않습니다.');</script>";
    }
?>

    <div class="topbar"> 
        <div class="logo-container">
            <a href="../main/main.php">
                <img class="logo" src="../img/PF_big.png" alt="none">
            </a>
        </div>
    </div>

    <form class="join_form" action='login_process.php' method = 'post' id = 'loginForm'>
        <h2>LOGIN</h2>
        <div class="login">
            <h1 class="text-position">LOGIN</h1>

            <div class="login_id">
                <input type="text" name="id" id="login_id" placeholder="아이디 또는 이메일"> 
            </div>

            <div class="login_pw">
                <input type="password" name="pw" id="login_pw" placeholder="비밀번호"> 
            </div>
            
            <div class="submit-login"> 
                <button type="submit">로그인</button> <!--로그인 눌렀을 때 이후 동작 js script 참고-->
            </div>

            <div class="line-container">
                <div class="line-text">OR</div>
            </div>
            
            <div class="text-position">
                <a class="font-a">아직 <a class="font-b">PF</a> 회원이 아니신가요?</a>
                <a href="../signup/signup.php" class="sign-custom">회원가입</a>
            </div>
        </div>
    </form>
</body>
</html>