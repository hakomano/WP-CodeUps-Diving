<!-- 「サイトマップ」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: サイトマップ
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Site <span>map</span></h1>
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

  <div class="site-map sub-site-map">
    <div class="sub-site-map__inner inner">
      <div class="sub-site-map__bg sub-bg sub-bg--pc-none">
        <div class="sub-site-map__list nav-list nav-list--map">
          <div class="nav-list__left">
            <div class="nav-list__box">
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>">キャンペーン</a>
                  <ul class="nav-list__child">
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/campaign_category/license' ) ); ?>">ライセンス講習</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/campaign_category/experience' ) ); ?>">体験ダイビング</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/campaign_category/fundiving' ) ); ?>">ファンダイビング</a>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">私たちについて</a>
                </li>
              </ul>
            </div>
            <div class="nav-list__box">
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/information' ) ); ?>">ダイビング情報</a>
                  <ul class=" nav-list__child">
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/information#tab-1' ) ); ?>">ライセンス講習</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/information#tab-3' ) ); ?>">体験ダイビング</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/information#tab-2' ) ); ?>">ファンダイビング</a>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">ブログ</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="nav-list__right">
            <div class="nav-list__box">
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>">お客様の声</a>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/price' ) ); ?>">料金一覧</a>
                  <ul class="nav-list__child">
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/price#price-license' ) ); ?>">ライセンス講習</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/price#price-fundiving' ) ); ?>">体験ダイビング</a>
                    </li>
                    <li class="nav-list__child-item">
                      <a href="<?php echo esc_url( home_url( '/price#price-experience' ) ); ?>">ファンダイビング</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="nav-list__box">
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">よくある質問</a>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map nav-list__item--indent">
                  <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">プライバシー<br class="u-mobile">ポリシー</a>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/terms-of-service' ) ); ?>">利用規約</a>
                </li>
              </ul>
              <ul class="nav-list__items">
                <li class="nav-list__item nav-list__item--map">
                  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">お問い合わせ</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>