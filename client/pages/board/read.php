<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  $gall_article_page = $_GET["page"] ?? false;

  if (!$gall_article_page) {
    $gall_article_page = 1;
  }

  $gall_gid = $_GET["gid"] ?? null;
  $gall_article_id = $_GET["aid"] ?? null;
  $gall_articleList_page = $_GET["gall_articleList_page"] ?? 0;

  if ($gall_gid && $gall_article_id) {
    $sql = "SELECT gall_articles.title, gall_articles.content, gall_articles.writer, gall_articles.uploaded_at, gall_articles.like, gall_articles.view , gall.name, gall.description, gall.created_at, gall.creator, users.name, users.is_admin
      FROM gall_articles
      INNER JOIN gall
      ON gall_articles.gall = gall.gid
      INNER JOIN users
      ON gall_articles.writer = users.uid
      WHERE gall_articles.id = ?
      AND gall_articles.gall = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $gall_article_id, $gall_gid);

    if ($stmt->execute()) {
      $stmt->bind_result($gall_article_title, $gall_article_content, $gall_article_writer, $gall_article_uploadedAt, $gall_article_like, $gall_article_view, $gall_name, $gall_desc, $gall_createdAt, $gall_creator, $gall_article_writer_dp, $user_isAdmin);
      if ($stmt->fetch()) {
        $gall_article_view += 1;
      } else {
      }
    } else {
    }
    $stmt->close();

    $sql = "UPDATE gall_articles
      SET gall_articles.view = ?
      WHERE gall_articles.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $gall_article_view, $gall_article_id);

    if($stmt->execute()) {
    } else {
    }
    $stmt->close();
  }
?>

<?php
  require_once "{$rootForReq}/inc/required/head.php";
?>

  <link rel="stylesheet" href="<?= $root ?>/client/assets/styles/part/globalset/article.css?q=<?php echo rand(1, 1000000) ?>">
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
          <?= $gall_name ?>&nbsp;갤러리
        </h2>
      </a>
      <div class="op-horiz"></div>
      <div class="op-head-articleWrap">
        <div class="op-head-article">
          <div>
            <div href="#" class="op-head-title">
              <p><?= $gall_article_title ?></p>
            </div>
          </div>
          <div class="op-head-article-detail">
            <div class="op-head-article-detail-oth">
              <a href="<?= $root ?>/gallog/<?= $gall_article_writer ?>"><?= $user_isAdmin ? "<b style='font-weight: 600;'>{$gall_article_writer_dp}</b>" : $gall_article_writer_dp ?></a>
              <span><?= $gall_article_uploadedAt ?></span>
            </div>
            <div>
              <span>조회 <?= $gall_article_view ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-item-onlyBG op-articleView">
      <div class="inner">
        <div class="content-item-main">
          <pre><?= $gall_article_content ?></pre>
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
  require_once "{$rootForReq}/utils/database/closedb.php";
?>