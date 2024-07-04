<?php
/*
텍스트로만 구성된 게시글의 미리보기 mip입니다.
root 페이지에서 뉴스 섹션과 공동사용 합니다.
이 mip은 list 생성을 위해 ../list/textonly.php에서 가공해야 합니다.
*/
?>

<tr>
  <td style="text-align: center; max-width: 56.7px;"><?= $gall_article_id ?></td>
  <td style="text-align: left; max-width: 321.3px;">
    <a href="<?= $root ?>/<?= $gall_gid ?>/<?= $gall_article_id ?><?php if ($gall_article_page != 1) { echo "?page={$gall_article_page}"; } ?>"><?= $gall_article_title ?></a>
    <div class="table-background"></div>
    <div class="table-border"></div>
  </td>
  <td style="text-align: center; max-width: 69.3px;">
    <a href="/gallog/<?= $user_uid ?>"><?= $user_isAdmin ? "<b style='font-weight: 600;'>{$user_name}</b>" : $user_name ?></a>
  </td>
  <td style="text-align: center; max-width: 69.3px;""><?= $gall_article_uploadedAt ?></td>
  <td style="text-align: center; max-width: 56.7px;""><?= $gall_article_like ?></td>
  <td style="text-align: center; max-width: 56.7px;""><?= $gall_article_view ?></td>
</tr>