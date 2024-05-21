<!-- 「FAQ」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: FAQ
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">FAQ</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-faq-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-faq-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- よくある質問一覧 -->
  <div class="sub-faq sub-layout">
    <div class="sub-faq__inner">
      <div class="sub-faq__bg sub-bg">
        <?php
          $faqGroup = SCF::get('faq_group');
          if ( $faqGroup[0]['faq_question'] || $faqGroup[0]['faq_answer'] ) : //『繰り返し』内の『サブフィールド』が入力されているかどうかを確認
        ?>
        <ul class="sub-faq__list faq-list">
          <?php
            foreach ( $faqGroup as $faqItem ) :
          ?>
          <li class="faq-list__item">
            <p class="faq-list__item-question js-faq-question">
              <?php echo esc_html( $faqItem['faq_question'] ); ?>
            </p>
            <p class="faq-list__item-answer">
              <?php echo nl2br( esc_html( $faqItem['faq_answer'] ) ); ?>
            </p>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>現在、質問がありません。</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>