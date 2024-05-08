<!-- 「ダイビング情報」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: ダイビング情報
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Information</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-info-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-info-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- ダイビング情報タブ -->
  <div class="sub-info sub-layout sub-layout--info">
    <div class="sub-info__inner inner">
      <div class="sub-info__bg sub-bg sub-bg--info">
        <div class="sub-info__tab tab-largish">
          <ul class="tab-largish__menu">
            <li class="tab-largish__menu-item js-tab current" id="tab-1-menu">
              <span>ライセンス<br class="u-mobile">講習</span>
            </li>
            <li class="tab-largish__menu-item js-tab" id="tab-2-menu">
              <span>ファン<br class="u-mobile">ダイビング</span>
            </li>
            <li class="tab-largish__menu-item js-tab" id="tab-3-menu">
              <span>体験<br class="u-mobile">ダイビング</span>
            </li>
          </ul>
        </div>
        <div class="sub-info__tab-content tab-content">
          <!-- ライセンス講習タブ中身 -->
          <div class="tab-content__box js-tab-content" id="tab-1">
            <ul class="tab-content__list info-list">
              <li class="info-list__item info-card">
                <div class="info-card__wrap">
                  <div class="info-card__text-box">
                    <h2 class="info-card__title">
                      ライセンス講習
                    </h2>
                    <div class="info-card__text">
                      泳げない人も、ちょっと水が苦手な人も、ダイビングを「安全に」楽しんでいただけるよう、スタッフがサポートいたします！スキューバダイビングを楽しむためには最低限の知識とスキルが要求されます。知識やスキルと言ってもそんなに難しい事ではなく、安全に楽しむ事を目的としたものです。プロダイバーの指導のもと知識とスキルを習得しCカードを取得して、ダイバーになろう！
                    </div>
                  </div>
                  <figure class="info-card__img">
                    <img src="<?php echo esc_url( get_theme_file_uri().'/images/info/info-license@2x.jpg' ); ?>"
                      alt="上空から見るスキューバダイビングをしている人達" width="492" height="313" loading="lazy" decoding="async">
                  </figure>
                </div>
              </li>
            </ul>
          </div>
          <!-- ファンダイビングタブ中身 -->
          <div class="tab-content__box js-tab-content" id="tab-2">
            <ul class="tab-content__list info-list">
              <li class="info-list__item info-card">
                <div class="info-card__wrap">
                  <div class="info-card__text-box">
                    <h2 class="info-card__title">
                      ファンダイビング
                    </h2>
                    <div class="info-card__text">
                      ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！
                    </div>
                  </div>
                  <figure class="info-card__img">
                    <img src="<?php echo esc_url( get_theme_file_uri().'/images/info/info-fundiving@2x.jpg' ); ?>"
                      alt="色とりどりの魚の大群がこちらに向かって泳いでくる様子" width="492" height="313" loading="lazy" decoding="async">
                  </figure>
                </div>
              </li>
            </ul>
          </div>
          <!-- 体験ダイビングタブ中身 -->
          <div class="tab-content__box js-tab-content" id="tab-3">
            <ul class="tab-content__list info-list">
              <li class="info-list__item info-card">
                <div class="info-card__wrap">
                  <div class="info-card__text-box">
                    <h2 class="info-card__title">
                      体験ダイビング
                    </h2>
                    <div class="info-card__text">
                      ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！
                    </div>
                  </div>
                  <figure class="info-card__img">
                    <img src="<?php echo esc_url( get_theme_file_uri().'/images/info/info-diving@2x.jpg' ); ?>"
                      alt="色とりどりの魚の大群がこちらに向かって泳いでくる様子" width="492" height="313" loading="lazy" decoding="async">
                  </figure>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>