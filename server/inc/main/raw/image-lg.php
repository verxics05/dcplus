<?php
/*
큰 이미지 사이즈를 가진 게시글의 미리보기 mip입니다.
root 페이지에서 뉴스 섹션과 공동사용 합니다.
이 mip은 list 생성을 위해 ../list/image-lg.php에서 가공해야 합니다.
*/
?>

<li>
  <a href="<?= $root ?>/">
    <div class="article-wrap">
      <div class="article">
        <div class="article-image">
          <img src="https://img1.daumcdn.net/thumb/R658x0.q70/?fname=https://t1.daumcdn.net/news/202406/28/hani/20240628113011234smmh.jpg" alt="">
        </div>
        <div class="article-title">
          <p>축구장에 폭 30m 싱크홀…영화 아닙니다</p>
        </div>
      </div>
    </div>
  </a>
</li>