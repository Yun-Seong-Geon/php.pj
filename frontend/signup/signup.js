function registerUser() { // 입력된 정보 가져오기
    var id = document.getElementById("sign_id").value;
    var pw = document.getElementById("sign_pw").value;
    var repass = document.getElementById("sign_rpw").value;
    var email = document.getElementById("sign_email").value;
    var name = document.getElementById("sign_name").value;

    if (!id || !pw || !repass || !email || !name) { // 필드 중 하나라도 비워져있으면 알림 출력후 함수 실행 중단
        alert("모든 필드를 입력해주세요.");
        return;
    }

    if (pw !== repass) {
        alert("비밀번호가 일치하지 않습니다."); // pw repass 일치 하지 않을시 알림 출력 후 함수 실행 중단
        return;
    }

    var isSuccess = true; 

    if (isSuccess) {
        alert("회원가입이 성공하였습니다.");
        window.location.href = "main.php"; //TODO:로고 클릭시 메인페이지 연결
    } else {
        alert("회원가입 실패: 중복된 아이디 또는 기타 이유로 인해 실패하였습니다.");
    }
}