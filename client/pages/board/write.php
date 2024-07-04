<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  if (!(isset($_SESSION["user_is_signin"]) && $_SESSION["user_is_signin"])) {
    return;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_SESSION["user_name"];
    $user_uid = $_SESSION["user_uid"];
    $write_title = isValid($_POST["write_title"]) ?? false;
    $write_content = isValid($_POST["write_content"]) ?? false;

    if (isset($_POST["gid"])) {
      $gall_gid = $_POST["gid"];
      $gall_name = $data["gall"]["name"] ?? "";

      $sql = "SELECT id 
        FROM gall 
        WHERE gid = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $gall_gid);

      if ($stmt->execute()) {
        $stmt->bind_result($bind_gall_name);
        if ($stmt->fetch()) {
          $gall_name = $bind_gall_name;
        } else {
          echo "해당 갤러리 찾지 못함.";
          return false;
        }
      } else {
        echo "db 오류";
      }
      $stmt->close();

      $sql = "INSERT INTO gall_articles (title, content, gall, writer) 
        VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $write_title, $write_content, $gall_gid, $user_uid);

      if ($stmt->execute()) {
        echo "게시글 작성 됨.";
        header("Location: {$root}/{$gall_gid}");
        exit();
      } else {
        echo "게시글 작성 실패.";
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
      <h2 style="margin-left: 140px;">글쓰기</h2>
    </a>
  </div>
  <div class="op-tag-form op-tag-form-special">
    <div class="inner">
      <form action="" method="POST">
        <input type="hidden" name="gid" value="<?= $_GET["gid"] ?? "" ?>">
        <div class="op-tag-form-special-input-group">
          <div class="op-tag-form-special-input-control">
            <input type="text" name="write_title" id="write_title" placeholder="제목을 입력하세요." maxlength="45">
          </div>
          <div class="op-tag-form-special-input-control">
            <textarea name="write_content" id="write_content" placeholder="내용을 입력하세요."></textarea>
          </div>
          <div class="op-tag-form-special-submit">
            <a href="<?= $_GET["return"] ?? $root ?>">취소</a>
            <button type="submit">등록</button>
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