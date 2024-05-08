<!-- 「私たちについて」固定ページ用のテンプレートファイル -->
<?php
/*
Template Name: 私たちについて
*/
get_header();
?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">About us</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-about-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-about-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- 私たちについてコンテンツ -->
  <div class="sub-about sub-layout">
    <div class="sub-about__inner inner">
      <div class="sub-about__bg sub-bg sub-bg--about">
        <div class="sub-about__content about-content">
          <div class="about-content__images">
            <div class="about-content__img about-content__img--left u-desktop">
              <picture>
                <source media="(min-width:768px)"
                  srcset="<?php echo esc_url( get_theme_file_uri().'/images/about/about-left-pc@2x.jpg' ); ?>">
                <img src="<?php echo esc_url( get_theme_file_uri().'/images/about/about-left-sp@2x.jpg' ); ?>"
                  alt="青空の下に見える瓦屋根の上のシーサー" width="128" height="194" loading="lazy" decoding="async">
              </picture>
            </div>
            <div class="about-content__img about-content__img--sub-right">
              <picture>
                <source media="(min-width:768px)"
                  srcset="<?php echo esc_url( get_theme_file_uri().'/images/about/about-right-pc@2x.jpg' ); ?>">
                <img src="<?php echo esc_url( get_theme_file_uri().'/images/about/about-right-sp@2x.jpg' ); ?>"
                  alt="海底付近を泳いでいる2匹の黄色い魚" width="281" height="186" loading="lazy" decoding="async">
              </picture>
            </div>
          </div>
          <div class="about-content__text-content about-content__text-content--btn-none">
            <h2 class="about-content__title about-content__title--sub-sp">Dive into<br>the Ocean</h2>
            <div class="about-content__textarea">
              <div class="about-content__text">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>

        <!-- ギャラリーフォトセクション -->
        <?php
          $galleryGroup = SCF::get('gallery_group');
          //ギャラリー画像が1枚もない場合はギャラリーセクション非表示
          if ( $galleryGroup[0]['gallery_img'] ) :
        ?>
        <section class="gallery sub-about-gallery">
          <div class="gallery__heading section-heading">
            <p class="section-heading__en">gallery</p>
            <h2 class="section-heading__ja">フォト</h2>
          </div>
          <ul class="gallery__list gallery-list">
            <?php
              foreach ( $galleryGroup as $galleryItem ) :
                $imgUrl = wp_get_attachment_image_src( $galleryItem['gallery_img'], 'full' );
                $imgAlt = $galleryItem['gallery_img_alt'];
            ?>
            <li class="gallery-list__item">
              <?php if ( $imgUrl ): ?>
              <div class="gallery-list__img js-modal-open">
                <img src="<?php echo esc_url( $imgUrl[0] ); ?>"
                  alt="<?php if ( $imgAlt ) { echo esc_html( $imgAlt ); } else { echo esc_html( "ギャラリー画像" ); } ?>">
              </div>
              <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </section>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- 画像モーダルウィンドウ -->
  <div class="sub-about__modal modal js-modal">
    <div class="modal__content"></div>
  </div>

  <?php get_footer(); ?>