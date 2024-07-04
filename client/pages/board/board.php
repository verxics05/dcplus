<?php
  session_start();

  require "../_help/rootForReq.php";
  require "{$rootForReq}/utils/database/connect.php";
  require_once "{$rootForReq}/utils/manage/url.root.php";

  $gall_article_page = $_GET["page"] ?? false;

  if (!$gall_article_page) {
    $gall_article_page = 1;
  }

  if (isset($_GET["gid"])) {
    $get_gall_gid = $_GET["gid"];

    $sql = "SELECT name, creator
      FROM gall
      WHERE gid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $get_gall_gid);

    if ($stmt->execute()) {
      $stmt->bind_result($bind_gall_name, $bind_gall_creator);
      if ($stmt->fetch()) {
        $gall_gid = $get_gall_gid;
        $gall_name = $bind_gall_name;
        $gall_creator = $bind_gall_creator;
      } else {
        echo "해당 갤러리 없음.";
        header("Location: /{$root}");
        exit();
      }
    } else {
      echo "데이터베이스 실행 실패.";
    }
    $stmt -> close();

    $sql = "SELECT COUNT(id)
      FROM gall_articles
      WHERE gall_articles.gall = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gall_gid);

    if ($stmt->execute()) {
      $stmt->bind_result($gall_article_numberOf);
      if ($stmt->fetch()) {
        $gall_article_page_numberOf = (int)$gall_article_numberOf / 50;
      }
    }
    $stmt->close();
  }
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
    <a href="<?= $root ?>/<?= $gall_gid ?>">
      <h2>
        <?= $gall_name ?>&nbsp;갤러리
      </h2>
    </a>
    <br>
    <div class="op-head-do">
      <form action="" method="GET" class="op-articleList-form">
        <div>
          <button type="submit" name="list" value="all" class="highlight">전체글</button>
          <button type="submit" name="list" value="pop">개념글</button>
          <button type="submit" name="list" value="notice">공지</button>
        </div>
      </form>
      <form action="" method="GET" class="op-articleList-form">
        <div>
          <a href="<?= $root ?>/<?= $gall_gid ?>/write?return=<?= $_SERVER["REQUEST_URI"] ?>" class="highlight">글쓰기</a>
        </div>
      </form>
    </div>
  </div>
  <div class="content-item op-articleList">
    <div class="inner">
      <div class="content-item-main">

        <?php
          require "{$rootForReq}/inc/main/list/textonly.php";
        ?>

      </div>
    </div>
  </div>
  <div class="op-articleList-pagination">
    <form action="<?= $root ?>/<?= $gall_gid ?>" method="GET" class="op-articleList-pagination-f">
      <div class="op-articleList-pagination-finner">

        <?php
          $gall_article_page_start = 1;
          $gall_article_page_end = 0;
          $gall_article_page_count = 0;

          # 페이지네이션 구현 (버튼)
          if ($gall_article_page > 9) {
            $gall_article_page_start = $gall_article_page;

            // echo var_dump($gall_article_page_start);

            if (($gall_article_page_start) % 10 == 0) {
              $gall_article_page_start = $gall_article_page_start - 9;
            } else if (($gall_article_page_start) % 10 == 1) {
              $gall_article_page_start = $gall_article_page_start;
            } else {
              $gall_article_page_start = (int)(substr($gall_article_page, 0, strlen($gall_article_page) - 1)) * 10 + 1;
            }
          }
        ?>

        <?php
          if (($gall_article_page_start - 1) > 0) {
        ?>
          <button type="submit" name="page" value="<?= $gall_article_page_start - 1 ?>" class="tomult">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <rect width="24" height="24" fill="none" />
            <path fill="currentColor" d="m10.414 9l-4 4H22v2H1.586L9 7.586z" />
          </svg>
          </button>
        <?php
          }
        ?>

        <?php
          for ($i=$gall_article_page_start;$i<=$gall_article_page_numberOf+1;$i++) {
        ?>

          <button type="submit" name="page" value="<?= $i ?>" class="<?= $gall_article_page == $i ? "on" : "" ?>"><?= $i ?></button>
        
        <?php 
            $gall_article_page_count ++;

            # 최대 10개의 버튼 나열
            if ($gall_article_page_count == 10) {
              break;
            }
          }
        ?>

        <?php

          if (($gall_article_page_start + 10) <= $gall_article_page_numberOf) {
        ?>
          <button type="submit" name="page" value="<?= $gall_article_page_start + 10 ?>" class="tomult">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <rect width="24" height="24" fill="none" />
              <path fill="currentColor" d="M15 7.586L22.414 15H2v-2h15.586l-4-4z" />
            </svg>
          </button>
        <?php
          }
        ?>

      </div>
    </form>
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