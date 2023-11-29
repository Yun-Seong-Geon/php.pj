
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">


</head>

<body>

    <header>
    <div class="top-image">
        <div class="top">
            <?php
            include '../topbar/topbar.php';
            ?>
            <h1>내 애완동물을 소개하세요.</h1>
        </div>
    </div>
    </header>
    <main>
        <section class="pf-overview">
            <h2>PF Overview</h2>
            <p class="pf_text">내 반려동물을 소개해보세요!</p>

            <div class="image-container">
                <img src="../img/petfolio.png" alt="반려동물 이미지" class="overview_img">
                <p class="pf_content">PF는 PET FOLIO의 약자입니다.<br> 여러분의 반려동물을 자랑하고 <br>더욱 깊어진 유대감을 경험하세요!</p>
            </div>

            <div class="text_container">

            </div>
        </section>

        <section class="ai-overview">
            <h2>AI Overview</h2>
            <p class="pf_text">내 반려동물을 분석해보세요!</p>

            <div class="classification-buttons">
                <div class="classification-button">
                    <img src="../img/img04.jpg" alt="cat">
                    <p>cat</p>
                </div>
                <div class="classification-button">
                    <img src="../img/img04.jpg" alt="dog">
                    <p>dog</p>
                </div>
                <div class="classification-button">
                    <img src="../img/img04.jpg" alt="wild">
                    <p>wild</p>
                </div>

            </div>
        </section>
    </main>

</body>

</html>