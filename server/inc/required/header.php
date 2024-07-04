<header>
  <div class="inner">
    <a href="<?= $root ?>/">
      <h1>#DCPLUS</h1>
    </a>
    <div class="head-search">
      <div class="head-search-inner">
        <form action="<?= $root ?>/search.php" method="get" class="head-search-group">
          <div class="head-search-control head-search-input">
            <input type="hidden" name="dt">
            <input type="text" name="kw" id="kw" placeholder="갤러리 & 통합검색">
          </div>
          <div class="head-search-control head-search-go">
            <button type="submit">
              <iconify-icon icon="mage:search"></iconify-icon>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>