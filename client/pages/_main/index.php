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

    <?php
      require_once "{$rootForReq}/inc/main/best-now.php";
      require "{$rootForReq}/inc/main/advertisement.php";
      require_once "{$rootForReq}/inc/main/news.php";
      require_once "{$rootForReq}/inc/main/pop.php";
    ?>

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
  require_once "{$rootForReq}/utils/database/closedb.php";
?>