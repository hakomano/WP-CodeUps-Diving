<!-- 「お問い合わせ完了」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: お問い合わせ完了
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Contact</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-contact-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-contact-sp@2x.jpg' ); ?>" alt=""
          width="375" height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <div class="sub-thanks sub-layout">
    <div class="sub-thanks__inner inner">
      <div class="sub-thanks__bg sub-bg">
        <p class="sub-thanks__text">
          お問い合わせ内容を送信完了しました。
        </p>
        <p class="sub-thanks__text">
          このたびは、お問い合わせ頂き<br class="u-mobile">誠にありがとうございます。<br>お送り頂きました内容を確認の上、<br
            class="u-mobile">3営業日以内に折り返しご連絡させて頂きます。<br>また、ご記入頂いたメールアドレスへ、<br class="u-mobile">自動返信の確認メールをお送りしております。
        </p>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>