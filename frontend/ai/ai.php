<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ai.css">
</head>
<body>
    <?php include '../topbar/topbar.php'; ?>

    <h1 class="font_a">Species AI</h1>
    <h3 class="font_b">나의 반려동물의 종을 판별해보세요!</h3>

    <?php

    // 결과가 세션에 저장되어 있는지 확인
    if (isset($_SESSION['prediction_result'])) {
        $response_data = $_SESSION['prediction_result'];

        // 처리된 이미지 표시
        if (isset($_SESSION['uploaded_image'])) {
            echo '<div class="image_container">';
            echo '<img src="' . $_SESSION['uploaded_image'] . '" alt="Processed Image" class="AI_image">';
            echo '</div>'; //
        }

        // 결과 표시
        if (isset($response_data['prediction'])) {
            echo "<p class='font_c'>당신의 반려동물은 " . htmlspecialchars($response_data['prediction']) . "입니다.</p>";
            echo '<div class="re_container">
                    <a href="../ai/ai.php" class="re_bt">다시하기</a>
                    </div>';
        } else {
            echo "<p class='font_b'>분류 결과를 받지 못했습니다.</p>";
        }

        // 세션 데이터 제거
        unset($_SESSION['prediction_result']);
        unset($_SESSION['processed_image']);
    } else {
        // 이미지 업로드 폼 표시
        ?>
        <div class="image_container">
            <img src="../img/white.png" id="default_image" class="AI_image" alt="">
            <img id="image_preview" class="AI_image" alt="이미지 미리보기" style="display: none;">
        </div>

        <form action="../ai/ai_process.php" name="ai_image" method="post" enctype="multipart/form-data">
            <div class="bt_container">
                <input type="file" name="image" id="image_input" accept="image/*" required>
                <button type="submit" class="submit_bt">분석</button>
            </div>
        </form>

        <script>
            document.getElementById('image_input').addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('default_image').style.display = 'none';
                        var output = document.getElementById('image_preview');
                        output.src = e.target.result;
                        output.style.display = 'block';
                    };
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                    document.getElementById('default_image').style.display = 'block';
                    document.getElementById('image_preview').style.display = 'none';
                }
            });
        </script>
        <?php
    }
    ?>
</body>
</html>
