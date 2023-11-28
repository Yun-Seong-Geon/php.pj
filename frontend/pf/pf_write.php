<?php
include '../topbar/topbar.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_PfWrite.css">
    <link rel="stylesheet" href="pf_write.css">
    <!-- <script src="pf_write.js"></script>  -->
</head>
<body>
    <div id="main_container">

        <div class="post_form_container">
                <form action="pf_write_process.php" method="post" enctype="multipart/form-data" class="post_form">
                
                    <div class="title">
                        NEW POST
                    </div>
                    <div class="preview">
                        <div class="upload">
                            <div class="post_btn">
                                <div class="plus_icon">
                                    <span></span>
                                    <span></span>
                                </div>
                                <p>포스트 이미지 추가</p>
                                <canvas id="imageCanvas"></canvas>
                                <!--<p><img id="img_id" src="#" style="width: 300px; height: 300px; object-fit: cover" alt="thumbnail"></p>-->
                            </div>
                        </div>
                    </div>
                    <p>
                        <input type="file" name="photo" id="id_photo" required="required" onchange="loadImage(event)">
                    </p>
                    <p>
                        <textarea name="content" id="text_field" cols="50" rows="5" placeholder="나의 반려동물을 자랑해보세요!"></textarea>

                    </p>
                    <input class="submit_btn" type="submit" value="저장">
            </form>

        </div>
        <script>
            function loadImage(event) {
                var canvas = document.getElementById('imageCanvas');
                var ctx = canvas.getContext('2d');
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = new Image();
                    img.onload = function() {
                        // 캔버스 크기 설정
                        var canvasWidth = 300; // 캔버스의 너비
                        var canvasHeight = 300; // 캔버스의 높이

                        // 이미지의 비율 유지를 위한 계산
                        var ratio = Math.min(canvasWidth / img.width, canvasHeight / img.height);
                        var newWidth = img.width * ratio;
                        var newHeight = img.height * ratio;
                        var xOffset = (canvasWidth - newWidth) / 2;
                        var yOffset = (canvasHeight - newHeight) / 2;

                        canvas.width = canvasWidth;
                        canvas.height = canvasHeight;
                        ctx.drawImage(img, xOffset, yOffset, newWidth, newHeight);
                    };
                    img.src = event.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            document.getElementById('id_photo').addEventListener('change', loadImage);
        </script>
</body>
</html>
