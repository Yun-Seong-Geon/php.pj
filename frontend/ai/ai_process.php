<?php
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['user_id'])) {
    // 로그인하지 않은 사용자는 로그인 페이지로 리디렉션
    header("Location: ../login/login.php");
    exit();
}

// 이미지가 업로드되었는지 확인
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $target_url = 'http://127.0.0.1:8000/predict/';
    $image_path = $_FILES['image']['tmp_name'];

    // cURL 세션 초기화
    $ch = curl_init($target_url);

    // cURL 옵션 설정
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('file'=> new CURLFile($image_path)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // 요청 실행 및 응답 받기
    $response = curl_exec($ch);

    // 에러 체크
    if(curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }

    // cURL 세션 종료
    curl_close($ch);

    // JSON 응답 파싱
    $response_data = json_decode($response, true);
    $_SESSION['prediction_result'] = $response_data;
    $image_data = file_get_contents($image_path);
    $base64_image = 'data:image/jpeg;base64,' . base64_encode($image_data);
    $_SESSION['uploaded_image'] = $base64_image;

    header("Location: ../ai/ai.php");
    exit();
} else {
    header("Location: ../path/to/your/form_page.php");
    exit();
}
?>


