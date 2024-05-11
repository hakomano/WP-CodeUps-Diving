<!-- 「お問い合わせ」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: お問い合わせ
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Contact</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url(get_theme_file_uri().'/images/fv/fv-sub-contact-pc@2x.jpg'); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url(get_theme_file_uri().'/images/fv/fv-sub-contact-sp@2x.jpg'); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- お問い合わせフォーム -->
  <div class="sub-contact sub-layout">
    <div class="sub-contact__inner">
      <div class="sub-contact__bg sub-bg">
        <!-- 未入力時エラーメッセージ -->
        <p class="sub-contact__error js-contact-error">
          ※必須項目が入力されていません。<br class="u-mobile">入力してください。
        </p>
        <p class="sub-contact__error js-check-error">
          ※必須項目がチェックされていません。<br class="u-mobile">選択してください。
        </p>
        <p class="sub-contact__error js-agree-error">
          ※個人情報の取り扱いについて同意がされていません。<br class="u-mobile">チェックしてください。
        </p>
        <!-- コンタクトフォーム -->
        <?php echo do_shortcode('[contact-form-7 id="5273b84" title="お問い合わせフォーム"]'); ?>
      </div>
    </div>
  </div>
</main>
<!-- reCAPTCHA表記(マーク非表示時) -->
<!-- This site is protected by reCAPTCHA and the Google
<a href="https://policies.google.com/privacy">Privacy Policy</a> and
<a href="https://policies.google.com/terms">Terms of Service</a> apply. -->
<?php get_footer(); ?>