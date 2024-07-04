<div class="content-signin content-item">
  <div class="inner">
    <div class="signin-box">
      <div class="signin-inner">

        <?php 
          if (isset($_SESSION['user_is_signin']) && $_SESSION['user_is_signin'] == true) {
        ?>

          <span><?= $_SESSION['user_uid'] ?>님, 접속을 환영합니다!</span>

        <?php 
          } else {
        ?>

        <form action="<?= $root ?>/auth/signin" method="POST">
          <input type="hidden" name="aid" value="<?= $_GET['aid'] ?? '' ?>">
          <input type="hidden" name="return" value="<?= isset($_GET['aid']) ? substr(trim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']), 0, strlen(trim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']))-1) : $_SERVER['REQUEST_URI'] ?>">
          <div class="signin-input-group">
            <div class="signin-input-control signin-inputUser">
              <input type="text" name="user_uid" id="user_uid" placeholder="식별코드" value="<?= isset($_SESSION['signin_error_user_uid']) ? $_SESSION['signin_error_user_uid'] : '' ?>">
              <i></i>
            </div>
            <div class="signin-input-control signin-inputUser">
              <input type="password" name="user_password" id="user_password" placeholder="비밀번호">
              <i></i>
            </div>
          </div>

          <?php 
            if (isset($_SESSION['signin_error'])) {
          ?>

            <p class="error"><?= $_SESSION['signin_error'] ?></p>

          <?php 
              unset($_SESSION['signin_error']);
              unset($_SESSION['signin_error_user_uid']);
            }
          ?>

          <div class="signin-input-group">
            <div class="signin-input-control signin-submit">
              <input type="submit" value="로그인">
            </div>
            <div class="signin-input-control signin-saveRecCode">
              <input type="checkbox" name="save_rec_code" id="save_rec_code">
              <label for="save_rec_code">코드저장</label>
            </div>
          </div>
        </form>

        <?php 
          } 
        ?>

        <hr>
        <div class="signin-more">

          <?php 
            if (isset($_SESSION['user_is_signin']) && $_SESSION['user_is_signin'] == true) {
          ?>

            <a href="<?= $root ?>/">마이페이지</a>
            <a href="<?= $root ?>/auth/signout?return=<?= $_SERVER['REQUEST_URI'] ?>">로그아웃</a>

          <?php 
            } else {
          ?>

            <a href="<?= $root ?>/auth/signup?return=<?= $_SERVER['REQUEST_URI'] ?>">고정닉신청</a>
            <a href="<?= $root ?>/auth/forgot?return=<?= $_SERVER['REQUEST_URI'] ?>">식별코드ㆍ비밀번호찾기</a>

          <?php 
            } 
          ?>

        </div>
      </div>
    </div>
  </div>
</div>