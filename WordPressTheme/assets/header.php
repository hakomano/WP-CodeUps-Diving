<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <?php wp_head(); ?>
</head>

<body>
  <!-- 404ページのみ一行追加 -->
  <?php if ( is_404() ): ?>
  <div class="body-container body-container--bg-green">
    <?php endif; ?>

    <!-- ローディングアニメーション※トップページのみ -->
    <?php if ( is_front_page() ): ?>
    <div class="loader js-loader">
      <div class="loader__title site-title site-title--green js-loader-title">
        <div class="site-title__main">diving</div>
        <p class="site-title__sub">
          into the ocean
        </p>
      </div>
      <div class="loader__images">
        <div class="loader__left-img js-loader-left">
          <picture>
            <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/common/loader-left-pc@2x.jpg' ); ?>"
              media="(min-width: 768px)">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/loader-left-sp@2x.jpg' ); ?>"
              alt="ローディング画面用の泳いでいるウミガメ" width="187" height="667" decoding="async">
          </picture>
        </div>
        <div class="loader__right-img js-loader-right">
          <picture>
            <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/common/loader-right-pc@2x.jpg' ); ?>"
              media="(min-width: 768px)">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/loader-right-sp@2x.jpg' ); ?>"
              alt="ローディング画面用の泳いでいるウミガメ" width="187" height="667" decoding="async">
          </picture>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- ヘッダー -->
    <header class="header js-header">
      <div class="header__inner">
        <!-- サイトロゴ：トップページのみサイトロゴをh1タグ、その他ページはdivタグ -->
        <?php $tag = ( is_front_page() ) ? 'h1' : 'div'; ?>
        <<?php echo esc_html( $tag ); ?> class="header__logo logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/logo.svg' ); ?>" alt="code upsのロゴ"
              width="133" height="50">
          </a>
        </<?php echo esc_html( $tag ); ?>>

        <!-- ハンバーガーボタン -->
        <button class="header__hamburger js-hamburger" aria-label="メニューを開く">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <!-- ドロワーメニュー(SP) -->
        <div class="header__drawer js-drawer">
          <nav class="header__drawer-nav nav-list">
            <div class="nav-list__left">
              <div class="nav-list__box">
                <ul class="nav-list__items">
                  <li class="nav-list__item">
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
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">私たちについて</a>
                  </li>
                </ul>
              </div>
              <div class="nav-list__box">
                <ul class="nav-list__items">
                  <li class="nav-list__item">
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
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">ブログ</a>
                  </li>
                </ul>
                <ul class="nav-list__items">
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>">お客様の声</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="nav-list__right">
              <div class="nav-list__box">
                <ul class="nav-list__items">
                  <li class="nav-list__item">
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
                      <li class="nav-list__child-item nav-list__child-item--indent">
                        <a href="<?php echo esc_url( home_url( '/price#price-spdiving' )); ?>">スペシャル<br
                            class="u-mobile">ダイビング</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="nav-list__box">
                <ul class="nav-list__items">
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">よくある質問</a>
                  </li>
                </ul>
                <ul class="nav-list__items">
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/sitemap' )); ?>">サイトマップ</a>
                  </li>
                </ul>
                <ul class="nav-list__items">
                  <li class="nav-list__item nav-list__item--indent">
                    <a href="<?php echo esc_url( home_url( '/privacypolicy' ) ); ?>">プライバシー<br class="u-mobile">ポリシー</a>
                  </li>
                </ul>
                <ul class="nav-list__items">
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/terms-of-service' ) ); ?>">利用規約</a>
                  </li>
                </ul>
                <ul class="nav-list__items">
                  <li class="nav-list__item">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">お問い合わせ</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <!-- PCヘッダーナビ -->
        <nav class="header__pc-nav pc-nav">
          <ul class="pc-nav__items">
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>"><span class="en">campaign</span><span
                  class="ja">キャンペーン</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>"><span class="en">about us</span><span
                  class="ja">私たちについて</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/information' ) ); ?>"><span class="en">information</span><span
                  class="ja">ダイビング情報</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><span class="en">blog</span><span
                  class="ja">ブログ</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>"><span class="en">voice</span><span
                  class="ja">お客様の声</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/price' ) ); ?>"><span class="en">price</span><span
                  class="ja">料金一覧</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><span class="en">FAQ</span><span
                  class="ja">よくある質問</span></a>
            </li>
            <li class="pc-nav__item">
              <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><span class="en">contact</span><span
                  class="ja">お問い合わせ</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </header>