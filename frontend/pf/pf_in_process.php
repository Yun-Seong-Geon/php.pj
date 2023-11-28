<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "petfolio";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

if (isset($_POST['delete_post']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // 로그인 상태 확인
    if (!isset($_SESSION['user_id'])) {
        echo "로그인이 필요합니다.";
        exit;
    }

    // 게시글 작성자 확인
    // 게시글의 작성자 ID를 조회하는 쿼리를 작성하고 실행
    $query = "SELECT author FROM pf WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ($row['author'] == $_SESSION['user_name']) {
            // 게시글 삭제 쿼리 실행
            $deleteQuery = "DELETE FROM pf WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $post_id);
            $deleteStmt->execute();

            if ($deleteStmt->affected_rows > 0) {
                echo "게시글이 삭제되었습니다.";
            } else {
                echo "게시글 삭제에 실패했습니다.";
            }
        } else {
            echo "자신이 작성한 게시글만 삭제할 수 있습니다.";
        }
    } else {
        echo "게시글을 찾을 수 없습니다.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pf/pf.php");
    exit();
}
?>
