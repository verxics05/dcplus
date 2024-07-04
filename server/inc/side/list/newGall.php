<?php
  # 여기에 설명을 작성하세요.
  $sql = "SELECT gall.gid, gall.name
    FROM gall
    ORDER BY gall.created_at DESC
    LIMIT 10 OFFSET 0";
  $stmt = $conn->prepare($sql);

  # 여기에 설명을 작성하세요.
  if ($stmt->execute()) {
    $stmt->bind_result($gall_gid, $gall_name);
?>

  <ul>

    <?php
      while ($rows = $stmt->fetch()) {
    ?>
      <li>
        <a href="<?= $root ?>/<?= $gall_gid ?>"><?= $gall_name ?></a>
      </li>
    <?php
      }
    ?>

  </ul>

<?php
  } else {
  }

  # SQL문을 저장하는 변수를 초기화함
  $stmt->close();
?>