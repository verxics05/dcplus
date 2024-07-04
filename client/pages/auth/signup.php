<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  $pattern = "/^[a-zA-Z0-9가-힣]/";
  $alnumWithPattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  function generateRandomString($length = 10) {
    global $alnumWithPattern;
    $randomString = '';
    for ($i=0;$i<$length+1;$i++) {
      $randomString .= $alnumWithPattern[rand(0, strlen($alnumWithPattern)-1)];
    }
    return $randomString;
  }

  $errors = [];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_pre = generateRandomString();

    $user_uid_pre = $user_pre;
    $user_name_pre = $user_pre;

    $user_uid = $user_name = $user_email = $user_password = $user_password_confirm = $user_desc = '';

    if ($_POST["user_uid"]) {
      if (!preg_match($pattern, $_POST['user_uid'])) {
        array_push($errors, '식별코드는 특수문자를 포함할 수 없습니다.');
        return;
      }
      $user_uid = $_POST["user_uid"];
    } else {
      $user_uid = $user_uid_pre;
    }

    if ($_POST["user_name"]) {
      if (!preg_match($pattern, $_POST['user_uid'])) {
        array_push($errors, '닉네임은 특수문자를 포함할 수 없습니다.');
        return;
      }
      $user_name = $_POST["user_name"];
    } else {
      $user_name = $user_name_pre;
    }

    if (!$_POST["user_password"]) {
      array_push($errors, '비밀번호를 입력해 주세요.');
    } else {
      $user_password = $_POST["user_password"];
    }

    if ($_POST["user_password_confirm"]) {
      if (isset($_POST["user_password"]) && $_POST["user_password"] !== $_POST["user_password_confirm"]) {
        array_push($errors, '비밀번호 확인 값이 최초 입력한 비밀번호와 일치하지 않습니다.');
        return;
      }
      $user_password_confirm = $_POST["user_password_confirm"];
    } else {
      array_push($errors, '비밀번호 확인을 입력해 주세요.');
    }

    if ($_POST['user_email']) {
      if (filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
        $user_email = $_POST["user_email"];
      } else {
        array_push($errors, '이메일을 메일 주소 형식으로 입력해 주세요.');
      }
    } else {
      array_push($errors, '이메일을 입력해 주세요.');
    }

    if ($_POST['user_desc']) {
      $user_desc = $_POST['user_desc'];
    }

    // echo "1. $user_name, 2. $user_uid, 3. $user_email";
    // return;

    if (!$errors) {
      $password_hashed = password_hash($user_password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (uid, name, password, email, description) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssss", $user_uid, $user_name, $password_hashed, $user_email, $user_desc);
      if ($stmt->execute()) {
        $_SESSION["user_is_signin"] = true;
        $_SESSION["user_uid"] = $user_uid;
        $_SESSION["user_name"] = $user_name;
        header("Location: {$root}/");
        exit();
      } else {
      }
      $stmt->close();
    } else {
      return;
    }
  }
?>

<?php
  require_once "{$rootForReq}/utils/manage/url.root.php";
  require_once "{$rootForReq}/inc/required/head.php";
?>

  <link rel="stylesheet" href="<?= $root ?>/client/assets/styles/form.css?q=<?php echo rand(1, 1000000) ?>">
</head>

<?php
  require_once "{$rootForReq}/inc/required/body-start.php";
?>

<?php
  require_once "{$rootForReq}/inc/required/header.php";
  require_once "{$rootForReq}/inc/required/gnb.php";
  require_once "{$rootForReq}/inc/required/recent.php";
  require_once "{$rootForReq}/inc/required/contentbody-start.php";
?>

<div class="content">
  <div class="op-head">
    <a href="<?= $root ?>">
      <h2>회원가입</h2>
    </a>
  </div>
  <div class="content-item op-tag-form">
    <div class="inner">
      <?php if ($errors) { ?>
        <div>
          <?php foreach($errors as $index => $error) { $index ++; echo "<p style='color: #ff0000; font-size: 10px; font-weight: 400;'>{$index}. {$error}</p>"; } ?>
          <br>
        </div>
      <?php } ?>
      <form action="<?= $root ?>/auth/signup" method="POST">
        <div class="op-tag-form-input-group">
          <div class="op-tag-form-input-control">
            <label for="user_uid">식별코드:</label>
            <input type="text" name="user_uid" id="user_uid" placeholder="필수 | 미입력 시 임의로 생성후 통보">
          </div>
          <div class="op-tag-form-input-control">
            <label for="user_name">닉네임:</label>
            <input type="text" name="user_name" id="user_name" placeholder="필수 | 미입력 시 식별코드와 동일한 것으로 간주">
          </div>
          <div class="op-tag-form-input-control">
            <label for="user_desc">자기소개:</label>
            <input type="text" name="user_desc" id="user_desc" placeholder="선택 | 갤로그에 명시">
          </div>
          <div class="op-tag-form-input-control">
            <label for="user_password">비밀번호:</label>
            <input type="password" name="user_password" id="user_password" placeholder="필수 | 미입력 시 가입 불가">
          </div>
          <div class="op-tag-form-input-control">
            <label for="user_password_confirm">비밀번호 확인:</label>
            <input type="password" name="user_password_confirm" id="user_password_confirm" placeholder="필수 | 미입력 시 가입 불가">
          </div>
          <div class="op-tag-form-input-control">
            <label for="user_email">이메일:</label>
            <input type="email" name="user_email" id="user_email" placeholder="필수 | 식별코드 및 비밀번호 찾기에 이용">
          </div>
          <div class="op-tag-form-submit">
            <button type="submit">가입</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  require_once "{$rootForReq}/inc/required/contentbody-end.php";
  require_once "{$rootForReq}/inc/required/footer.php";
  require_once "{$rootForReq}/inc/required/body-end.php";

  require_once "{$rootForReq}/utils/database/closedb.php";
?>