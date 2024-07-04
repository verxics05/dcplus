<div class="gnb">
  <div class="inner gnb-inner">
    <ul class="step1">
      <li class="import-cascade">
        <a href="<?= $root ?>/galleries">갤러리</a>
        <ul class="step2">
          <li>
            <a href="<?= $root ?>/galleries?category=game">게임</a>
          </li>
          <li>
            <a href="<?= $root ?>/galleries?category=enter">연예/방송</a>
          </li>
          <li>
            <a href="<?= $root ?>/galleries?category=sports">스포츠</a>
          </li>
          <li>
            <a href="<?= $root ?>/galleries?category=edu">교육/금융/IT</a>
          </li>
          <li>
            <a href="<?= $root ?>/galleries?category=travel">여행/음식/생물</a>
          </li>
          <li>
            <a href="<?= $root ?>/galleries?category=hobby">취미/생활</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="<?= $root ?>/gallog">갤로그</a>
      </li>
      <li>
        <a href="<?= $root ?>/news">플러스뉴스</a>
      </li>
      <li>
        <a href="<?= $root ?>/cons">플러스콘</a>
      </li>
      <li class="import-cascade">
        <a href="<?= $root ?>">개발도구</a>
        <ul class="step2">
          <li>
            <a href="<?= $root ?>/auth/signup">인증 > 회원가입</a>
          </li>
          <li class="cascade-divide">
            <hr>
          </li>
          <li>
            <a href="<?= $root ?>/create">갤러리 > 개설</a>
          </li>
          <li>
            <a href="<?= $root ?>/indev">갤러리 > 메인</a>
          </li>
          <li>
            <a href="<?= $root ?>/indev/1">갤러리 > 뷰어</a>
          </li>
          <li>
            <a href="<?= $root ?>/indev/write">갤러리 > 글쓰기</a>
          </li>
          <li>
            <a href="<?= $root ?>/pluslab/write-lq?gid=labor&return=<?= $_SERVER["REQUEST_URI"] ?>">갤러리 > 일괄글쓰기</a>
          </li>
          <li>
            <a href="<?= $root ?>/pluslab/views-crack?return=<?= $_SERVER["REQUEST_URI"] ?>">갤러리 > 조회수 증가시키기</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>