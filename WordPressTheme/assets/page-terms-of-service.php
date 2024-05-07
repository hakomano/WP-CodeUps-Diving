<!-- 「利用規約」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: 利用規約
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Terms of Service</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-common-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-common-sp@2x.jpg' ); ?>" alt=""
          width="375" height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- 利用規約 本文 -->
  <section class="sub-terms-of-service sub-layout">
    <div class="sub-terms-of-service__inner">
      <div class="sub-terms-of-service__bg sub-bg">
        <h2 class="sub-terms-of-service__title"><?php the_title(); ?></h2>
        <div class="sub-terms-of-service__text-box">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>