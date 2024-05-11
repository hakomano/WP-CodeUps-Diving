<!-- 共通CTAセクション(一部ページは非表示) -->
<?php if ( !( is_page('contact') || is_page('contact-thanks') || is_404()) ): ?>
<section class="cta <?php
    if ( is_front_page() ){
      echo 'top-cta';
    } elseif ( is_page("sitemap") ){
      echo 'sub-cta sub-cta--map-margin';
    } else {
      echo 'sub-cta';
    }
  ?>" id="cta">
  <div class="cta__inner inner">
    <div class="cta__container">
      <div class="cta__info">
        <div class="cta__logo logo">
          <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/logo-green.svg' ); ?>" alt="code upsのロゴ"
            width="200" height="75">
        </div>
        <hr>
        <div class="cta__info-flex">
          <?php
          // グループフィールドを取得
          $ctaInfo = get_field('cta_info','8');
          // グループフィールド内の「住所」フィールドを取得
          $add = $ctaInfo['add'];
          // グループフィールド内の「電話番号」フィールドを取得
          $tel = $ctaInfo['tel'];
          // グループフィールド内の「営業開始時間」フィールドを取得
          $openHours = $ctaInfo['open_hours'];
          // グループフィールド内の「営業終了時間」フィールドを取得
          $closeHours = $ctaInfo['close_hours'];
          // グループフィールド内の「定休日」フィールドを取得
          $holiday = $ctaInfo['holiday'];
        ?>
          <div class="cta__info-detail">
            <?php if ( $add ): ?>
            <address>
              <p><?php echo esc_html( $add ); ?></p>
            </address>
            <?php endif;?>
            <?php if ( $tel ): ?>
            <address>
              <a href="tel:<?php echo esc_html( $tel ); ?>">
                <p>TEL:<span><?php echo esc_html( $tel ); ?></span></p>
              </a>
            </address>
            <?php endif;?>
            <?php if ( $openHours && $closeHours ): ?>
            <p>営業時間:<span><?php echo esc_html( $openHours ); ?>-<?php echo esc_html( $closeHours ); ?></span></p>
            <?php endif;?>
            <?php if ( $holiday ): ?>
            <p>定休日:<span><?php echo esc_html( $holiday ); ?></span></p>
            <?php endif;?>
          </div>
          <div class="cta__info-map">
            <?php
                $map_url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57272.560037403666!2d127.69363324863279!3d26.2118006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34e56d2cf193f5a9%3A0x82601d45c6cb5d01!2z44Kt44Oj44OX44OG44Oz44Oq44K-44O844OI!5e0!3m2!1sja!2sjp!4v1710830816059!5m2!1sja!2sjp';
              ?>
            <iframe src="<?php echo esc_url( $map_url ); ?>" width="600" height="450" style="border:0;"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
      <div class="cta__link">
        <div class="cta__heading section-heading">
          <p class="section-heading__en section-heading__en--big">contact</p>
          <h2 class="section-heading__ja section-heading__ja--big">お問い合わせ</h2>
        </div>
        <p class="cta__text">
          ご予約・お問い合わせはコチラ
        </p>
        <div class="cta__btn">
          <a href="<?php echo esc_url( home_url( '/contact' )); ?>" class="button">
            <div></div><span>contact us</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<?php endif; ?>

<!-- フッター -->
<footer class="footer <?php
    if ( is_front_page() ){
      echo 'top-footer';
    } elseif ( is_page("contact") || is_page("contact-thanks") ){
      echo 'sub-footer sub-footer--contact';
    } elseif ( is_404() ){
      echo 'sub-footer sub-footer--page404';
    } else {
      echo 'sub-footer';
    }
  ?>">
  <div class="footer__inner inner">
    <div class="footer__head">
      <div class="footer__logo logo">
        <a href="<?php echo esc_url( home_url( '/' )); ?>">
          <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/logo.svg' ); ?>" alt="code upsのロゴ"
            width="200" height="75">
        </a>
      </div>
      <div class="footer__sns">
        <?php
          // グループフィールドを取得
          $snsLink = get_field('sns_links','8');
          // グループフィールド内の「フェイスブックリンク」フィールドを取得
          $fbLink = $snsLink['facebook_link'];
          // グループフィールド内の「インスタリンク」フィールドを取得
          $instaLink = $snsLink['instagram_link'];
          // グループフィールド内の「Xリンク」フィールドを取得
          $xLink = $snsLink['x_link'];
        ?>
        <?php if ( $fbLink ): ?>
        <a href="<?php echo esc_url( $fbLink ); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/facebook-logo.svg' ); ?>"
            alt="フェイスブックのアイコン" width="32" height="32">
        </a>
        <?php endif;?>
        <?php if ( $instaLink ): ?>
        <a href="<?php echo esc_url( $instaLink ); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/instagram-logo.svg' ); ?>"
            alt="インスタグラムのアイコン" width="32" height="32">
        </a>
        <?php endif;?>
        <?php if ( $xLink ): ?>
        <a href="<?php echo esc_url( $xLink ); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/x-logo.svg' ); ?>" alt="Xのアイコン" width="32"
            height="32">
        </a>
        <?php endif;?>
      </div>
    </div>
    <div class="footer__list nav-list">
      <div class="nav-list__left">
        <div class="nav-list__box">
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/campaign' )); ?>">キャンペーン</a>
              <ul class="nav-list__child">
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/campaign_category/license' )); ?>">ライセンス講習</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/campaign_category/fundiving' )); ?>">ファンダイビング</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/campaign_category/experience' )); ?>">体験ダイビング</a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/about-us' )); ?>">私たちについて</a>
            </li>
          </ul>
        </div>
        <div class="nav-list__box">
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/information' )); ?>">ダイビング情報</a>
              <ul class=" nav-list__child">
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/information#tab-1' )); ?>">ライセンス講習</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/information#tab-2' )); ?>">ファンダイビング</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/information#tab-3' )); ?>">体験ダイビング</a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/blog' )); ?>">ブログ</a>
            </li>
          </ul>
          <ul class="nav-list__items u-mobile">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/voice' )); ?>">お客様の声</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="nav-list__right">
        <div class="nav-list__box">
          <ul class="nav-list__items u-desktop">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/voice' )); ?>">お客様の声</a>
            </li>
          </ul>
          <ul class="nav-list__items nav-list__items--sp-margin">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/price' )); ?>">料金一覧</a>
              <ul class="nav-list__child">
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/price#price-license' )); ?>">ライセンス講習</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/price#price-fundiving' )); ?>">体験ダイビング</a>
                </li>
                <li class="nav-list__child-item">
                  <a href="<?php echo esc_url( home_url( '/price#price-experience' )); ?>">ファンダイビング</a>
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
              <a href="<?php echo esc_url( home_url( '/faq' )); ?>">よくある質問</a>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/sitemap' )); ?>">サイトマップ</a>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item nav-list__item--indent">
              <a href="<?php echo esc_url( home_url( '/privacypolicy' )); ?>">プライバシー<br class="u-mobile">ポリシー</a>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/terms-of-service' )); ?>">利用規約</a>
            </li>
          </ul>
          <ul class="nav-list__items">
            <li class="nav-list__item">
              <a href="<?php echo esc_url( home_url( '/contact' )); ?>">お問い合わせ</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <small class="footer__copyright">Copyright &copy; 2021 - <?php echo esc_html( date('Y') ); ?> CodeUps LLC. All
      Rights
      Reserved.</small>
  </div>
</footer>

<!-- 共通：トップへ戻るボタン(404ページ以外) -->
<?php if ( !is_404() ): ?>
<div class="page-top-btn js-page-top">
  <button aria-label="ページトップに戻る"></button>
</div>
<?php endif; ?>

<!-- 404ページのみ一行追加 -->
<?php if ( is_404() ): ?>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>