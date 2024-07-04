<div class="content-item content-advertisement content-advertisement-y">
  <div class="inner content--noPadding">
    <div class="content-item-main">

      <?php
        if (isset($advertisement_is_available) && $advertisement_is_available) {
      ?>

        <img src="<?= $root ?>/" alt="광고">

      <?php
        } else {
      ?>

        <p style="font-size: 15px;">광고</p>

      <?php
        }
      ?>
      
    </div>
  </div>
</div>