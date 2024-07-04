<?php
# 아시아/서울 시간대로 설정
date_default_timezone_set('Asia/Seoul');

# 몇 번째 게시물부터 가져올지 선언
$sql_set_offset = ((int)$gall_article_page - 1) * 50;

# gid값이 존재하는 경우
if (isset($_GET['gid'])) {
  $gall_gid = $_GET['gid'];

  # 설명을 작성하세요.
  $sql = "SELECT gall_articles.id, gall_articles.title, gall_articles.content, gall_articles.gall, gall_articles.writer, gall_articles.uploaded_at, gall_articles.like, gall_articles.view, users.uid, users.name, users.is_admin
    FROM gall_articles
    INNER JOIN users
    ON gall_articles.writer = users.uid
    WHERE gall = ?
    ORDER BY id DESC
    LIMIT 50 OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $gall_gid, $sql_set_offset);

  # 미리 작성한 SQL문 실행
  # SQL문을 실행할 수 있는 경우
  if ($stmt->execute()) {
    $stmt->bind_result($gall_article_id, $gall_article_title, $gall_article_content, $gall_gid, $gall_article_writer, $gall_article_uploadedAt, $gall_article_like, $gall_article_view, $user_uid, $user_name, $user_isAdmin);
?>

<table>
  <thead>
    <tr>
      <th style="width: 9%; text-align: center;">번호</th>
      <th style="width: 51%; text-align: left;">제목</th>
      <th style="width: 11%; text-align: center;">작성자</th>
      <th style="width: 11%; text-align: center;">날짜</th>
      <th style="width: 9%; text-align: center;">추천</th>
      <th style="width: 9%; text-align: center;">조회수</th>
    </tr>
  </thead>
  <tbody>

    <?php
      while ($row = $stmt->fetch()) {
        $thisYear = Date('Y'); // 2024
        $thisMonth = Date('m'); // 06
        $thisDay = Date('d'); // 29
        $date = date_create($gall_article_uploadedAt);
        $uploadedAt_year = date_format($date, "Y");
        $uploadedAt_month = date_format($date, "m");
        $uploadedAt_day = date_format($date, "d");

        # 보여지는 날짜 정보 수정
        if ($thisYear == $uploadedAt_year) {
          if ($thisMonth == $uploadedAt_month && $thisDay == $uploadedAt_day) {
            $gall_article_uploadedAt = date_format($date, 'H:i');
          } else {
            $gall_article_uploadedAt = date_format($date, 'm/d');
          }
        } else if ($thisYear != $uploadedAt_year) {
          $gall_article_uploadedAt = date_format($date, 'Y/m/d');
        }
    ?>

      <?php
        require __DIR__ . '/../raw/textonly.php';
      ?>

      <?php
          }
        }

        # SQL문을 저장하는 변수를 초기화함
        $stmt->close();
      }
    ?>

  </tbody>
</table>