<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">


</head>

<body class="main-page">
    <div class="top-image">
        <div class="top">
            <?php
            include '../topbar/topbar.php';
            ?>
            <h1>내 애완동물을 소개하세요.</h1>
        </div>
    </div>

    <section class="pf-overview">
        <h2>PF Overview</h2>
        <h3>내 반려동물을 소개해보세요!</h3>

        <p>PF는 PET FOLIO의 약자입니다. 애완동물 포트폴리오를 관리하고 다양한 애완동물 관련 정보를 확인하세요.</p>
    </section>
    <section class="ai-overview">
        <h2>AI Overview</h2>
        <p>내 반려동물을 분석해보세요!</p>
        <!-- 분류 버튼 -->
        <div class="classification-buttons">
            <button>cat</button>
            <button>dog</button>
            <button>wild</button>
        </div>
    </section>
    </div>

</body>

</html>