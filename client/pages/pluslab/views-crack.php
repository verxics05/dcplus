<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";
?>

<?php
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
      <h2 style="margin-left: 140px;">조회수 조작</h2>
    </a>
  </div>
  <div class="op-tag-form op-tag-form-special">
    <div class="inner">
      <form action="" method="POST">
        <input type="hidden" name="gid" value="<?= $_GET["gid"] ?? "" ?>">
        <div class="op-tag-form-special-input-group">
          <div class="op-tag-form-special-input-control">
            <label for="vc_num">올릴 조회수: </label>
            <br>
            <span id="vc_num">1</span>
            <input type="range" name="vc_num" id="vc_num" min="1" max="10000" value="1" onchange="fetchValue(this.value);">
          </div>
          <div class="op-tag-form-special-input-control">
            <input type="text" name="vc_aid" id="vc_aid" placeholder="대상 AID">
          </div>
          <div class="op-tag-form-special-submit">
            <a href="<?= $_GET["return"] ?? $root ?>">취소</a>
            <button type="submit">조회수 올리기</button>
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

<script>
  function fetchValue(num) {
    document.querySelector('#vc_num').textContent = num;
  }
</script>

<?php
  require_once "{$rootForReq}/inc/required/body-end.php";
  require_once "{$rootForReq}/utils/database/closedb.php";
?>