<!-- 「料金一覧」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: 料金一覧
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Price</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-price-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-price-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- 料金一覧表 -->
  <div class="sub-price sub-layout">
    <div class="sub-price__inner inner">
      <div class="sub-price__bg sub-bg">
        <div class="sub-price__list sub-price-list">
          <!-- ライセンス講習コース料金表(SCF) -->
          <?php
            $priceLicense = SCF::get('price_license');
            if ( $priceLicense ) :
          ?>
          <div class="sub-price-list__block" id="price-license">
            <div class="sub-price-list__title-box">
              <h2 class="sub-price-list__title">ライセンス講習</h2>
            </div>
            <dl class="sub-price-list__item">
              <?php
                foreach ( $priceLicense as $licenseItem ) :
              ?>
              <dt>
                <?php echo esc_html( $licenseItem['price_license_content'] ); ?>
              </dt>
              <dd>
                &yen;<?php echo esc_html( number_format($licenseItem['price_license_fee']) ); ?>
              </dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>
          <!-- 体験ダイビングコース料金表(SCF) -->
          <?php
            $priceFundiving = SCF::get('price_fundiving');
            if ( $priceFundiving ) :
          ?>
          <div class="sub-price-list__block" id="price-fundiving">
            <div class="sub-price-list__title-box">
              <h2 class="sub-price-list__title">体験ダイビング</h2>
            </div>
            <dl class="sub-price-list__item">
              <?php
                foreach ( $priceFundiving as $fundivingItem ) :
              ?>
              <dt>
                <?php echo esc_html( $fundivingItem['price_fundiving_content'] ); ?>
              </dt>
              <dd>
                &yen;<?php echo esc_html( number_format($fundivingItem['price_fundiving_fee']) ); ?>
              </dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>
          <!-- ファンダイビングコース料金表(SCF) -->
          <?php
            $priceExperience = SCF::get('price_experience');
            if ( $priceExperience ) :
          ?>
          <div class="sub-price-list__block" id="price-experience">
            <div class="sub-price-list__title-box">
              <h2 class="sub-price-list__title">ファンダイビング</h2>
            </div>
            <dl class="sub-price-list__item">
              <?php
                foreach ( $priceExperience as $experienceItem ) :
              ?>
              <dt>
                <?php echo esc_html( $experienceItem['price_experience_content'] ); ?>
              </dt>
              <dd>
                &yen;<?php echo esc_html( number_format($experienceItem['price_experience_fee']) ); ?>
              </dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>
          <!-- スペシャルダイビングコース料金表(SCF) -->
          <?php
            $priceSpdiving = SCF::get('price_spdiving');
            if ( $priceSpdiving ) :
          ?>
          <div class="sub-price-list__block" id="price-spdiving">
            <div class="sub-price-list__title-box">
              <h2 class="sub-price-list__title">スペシャルダイビング</h2>
            </div>
            <dl class="sub-price-list__item">
              <?php
                foreach ( $priceSpdiving as $spdivingItem ) :
              ?>
              <dt>
                <?php echo esc_html( $spdivingItem['price_spdiving_content'] ); ?>
              </dt>
              <dd>
                &yen;<?php echo esc_html( number_format($spdivingItem['price_spdiving_fee']) ); ?>
              </dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>

          <!-- 新しいコースを追加する場合(CFS入力時) -->
          <?php
            $priceNew = CFS()->get('price_new');
            if ( is_array($priceNew) ):
              foreach ( $priceNew as $newItem ) :
                $newTitle = $newItem['price_new_title'];
          ?>
          <div class="sub-price-list__block">
            <div class="sub-price-list__title-box">
              <h2 class="sub-price-list__title">
                <?php echo esc_html( $newTitle ); ?>
              </h2>
            </div>
            <?php
              $priceNewContent = $newItem['price_new_content'];
              if ( is_array($priceNewContent) ):
            ?>
            <dl class="sub-price-list__item">
              <?php
                foreach ( $priceNewContent as $newContentItem ) :
                  if ( $newContentItem['price_new_detail'] ):
              ?>
              <dt>
                <?php echo esc_html( $newContentItem['price_new_detail'] ); ?>
              </dt>
              <?php
                endif;
                if ( $newContentItem['price_new_fee'] ):
              ?>
              <dd>
                &yen;<?php echo esc_html( number_format($newContentItem['price_new_fee']) ); ?>
              </dd>
              <?php endif; endforeach; ?>
            </dl>
            <?php endif; ?>
          </div>
          <?php endforeach; endif; ?>

        </div>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>