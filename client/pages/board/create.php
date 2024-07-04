<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  $pattern = "/^[a-z0-9가-힣]/";

  if (!(isset($_SESSION["user_is_signin"]) && $_SESSION["user_is_signin"])) {
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_uid = $_SESSION["user_uid"];
    $user_name = $_SESSION["user_name"];

    if (!isset($_POST["gall_gid"])) {
    }
    if (!isset($_POST["gall_name"])) {
    }
    if (!isset($_POST["gall_desc"])) {
    }

    $gall_gid = isValid($_POST["gall_gid"]) ?? false;
    $gall_name = isValid($_POST["gall_name"]) ?? false;
    $gall_desc = isValid($_POST["gall_desc"]) ?? false;

    if ($gall_gid && $gall_name && $gall_desc) {
      $sql = "INSERT INTO gall (gid, name, description, creator)
        VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $gall_gid, $gall_name, $gall_desc, $user_uid);

      if ($stmt->execute()) {
        echo "갤러리 개설 신청 완료. (즉시 승인), 갤러리 개설 완료.";
      } else {
      }
      $stmt->close();
    }
  }

  function isValid(&$arg) {
    $arg = htmlspecialchars($arg);
    $arg = stripslashes($arg);
    $arg = trim($arg);
    return $arg;
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
      <h2>갤러리 개설</h2>
    </a>
  </div>
  <div class="content-item op-tag-form">
    <div class="inner">
      <form action="" method="POST">
        <div class="op-tag-form-input-group">
          <div class="op-tag-form-input-control op-tag-form-hint--create">
            <label for="gall_name">이름:</label>
            <div class="op-tag-form-hint-group">
              <input type="text" name="gall_name" id="gall_name" placeholder="(한글/영문/숫자 최대 12글자)" maxlength="12">
              <div class="op-tag-form-hint">
                <span>갤러리</span>
              </div>
            </div>
          </div>
          <div class="op-tag-form-input-control">
            <label for="gall_gid">식별코드:</label>
            <input type="text" name="gall_gid" id="gall_gid" placeholder="(한글/영문/숫자 최대 16글자)" maxlength="16">
          </div>
          <div class="op-tag-form-input-control">
            <label for="gall_desc">설명:</label>
            <input type="text" name="gall_desc" id="gall_desc" placeholder="갤러리를 소개해 주세요.">
          </div>
          <div class="op-tag-form-submit">
            <button type="submit">신청</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
  require_once "{$rootForReq}/inc/required/contentbody-end.php";
  require_once "{$rootForReq}/inc/required/footer.php";
  require_once "{$rootForReq}/inc/required/wrap-end.php";
?>

<?php
  require_once "{$rootForReq}/inc/required/body-end.php";
  require_once "{$rootForReq}/utils/database/closedb.php";
?>