<!-- プラグイン:BreadCrumb使用 -->
<div class="breadcrumbs sub-breadcrumbs<?php if ( is_404() ){echo ' sub-breadcrumbs--page404';} ?>"
  vocab="https://schema.org" typeof="BreadcrumbList">
  <div class="sub-breadcrumbs__inner inner">
    <?php
      if ( function_exists( 'bcn_display' ) ) {
        bcn_display();
      }
    ?>
  </div>
</div>