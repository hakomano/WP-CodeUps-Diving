<!-- 「プライバシーポリシー」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: プライバシーポリシー
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Privacy Policy</h1>
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

  <!-- プライバシーポリシー 本文(管理画面から変更可) -->
  <section class="sub-privacy-policy sub-layout">
    <div class="sub-privacy-policy__inner">
      <div class="sub-privacy-policy__bg sub-bg">
        <h2 class="sub-privacy-policy__title"><?php the_title(); ?></h2>
        <div class="sub-privacy-policy__text-box">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>