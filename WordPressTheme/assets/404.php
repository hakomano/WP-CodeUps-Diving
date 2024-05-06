<?php get_header(); ?>
<main>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <section class="error sub-error">
    <div class="sub-error__inner inner">
      <h1 class="sub-error__title">404</h1>
      <p class="sub-error__text">
        申し訳ありません。<br>お探しのページが見つかりません。
      </p>
      <div class="sub-error__btn">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button--reversal">
          <div></div><span>page TOP</span>
        </a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>