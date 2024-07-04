<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";
?>

<?php
  require_once "{$rootForReq}/inc/required/head.php";
?>

  <link rel="stylesheet" href="<?= $root ?>/client/assets/styles/index.css?q=<?php echo rand(1, 1000000) ?>">
  <link rel="stylesheet" href="<?= $root ?>/client/assets/styles/part/main/articleList.css?q=<?php echo rand(1, 1000000) ?>">
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

<div class="content sep">
  <div class="content-main">
    <div class="op-head">
      <a href="<?= $root ?>/<?= $gall_gid ?><?php if ($gall_article_page != 1) { echo "?page={$gall_article_page}"; } ?>">
        <h2>
          페이지를 찾을 수 없습니다!
        </h2>
      </a>
      <div class="op-horiz"></div>
    </div>
    <div class="content-item-onlyBG">
      <div class="inner">
        <div class="content-item-main">
          <p>해당 URL이 정확하지 않거나, 다른 URL로 대체되었을 수 있습니다.</p>
          <br>
          <p>불편을 드려 죄송합니다.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="content-side">

    <?php
      require "{$rootForReq}/inc/side/signin.php";
      require "{$rootForReq}/inc/side/crowdedGall.php";
      require "{$rootForReq}/inc/side/advertisement.php";
      require "{$rootForReq}/inc/side/hGall.php";
      require "{$rootForReq}/inc/side/newGall.php";
    ?>

  </div>
</div>

<?php 
  require_once "{$rootForReq}/inc/required/contentbody-end.php";
  require_once "{$rootForReq}/inc/required/footer.php";
  require_once "{$rootForReq}/inc/required/wrap-end.php";
?>

<?php
  require_once "{$rootForReq}/inc/required/body-end.php";
?>