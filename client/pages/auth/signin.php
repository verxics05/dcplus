<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  $return = $_POST["return"];

  function signin_return($msg, $user_uid) {
    global $return;
    $_SESSION['signin_error_user_uid'] = $user_uid;
    $_SESSION['signin_error'] = $msg;
    header("Location: {$return}");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_uid = trim($_POST["user_uid"]) ?? false;
    $user_password = trim($_POST["user_password"]) ?? false;
    $aid = $_POST['aid'] ?? false;

    if (!($user_uid && $user_password)) {
      signin_return('아이디 또는 비밀번호가 입력되지 않았습니다.', $user_uid ?? '');
    }

    $sql = "SELECT uid, name, password
      FROM users
      WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_uid);

    if($stmt->execute()) {
      $stmt->bind_result($bind_user_id, $bind_user_name, $bind_hashed_password);
      if ($stmt->fetch()) {
        if (password_verify($user_password, $bind_hashed_password)) {
          $_SESSION["user_is_signin"] = true;
          $_SESSION["user_uid"] = $bind_user_id;
          $_SESSION["user_name"] = $bind_user_name;

          if ($aid) {
            $return .= "/{$aid}";
          }
          
          header("Location: {$return}");
          exit();
        } else {
          signin_return('비밀번호가 일치하지 않습니다.', $user_uid);
        }
      } else {
        signin_return('해당 식별코드를 사용하는 유저가 존재하지 않습니다.', $user_uid);
      }
    } else {
      signin_return('데이터베이스 작업 도중 오류가 발생했습니다.', $user_uid);
    }
    $stmt->close();
  }

  $conn->close();
?>