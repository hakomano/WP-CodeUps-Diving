<?php get_header(); ?>

<main>
  <!-- ファーストビュー -->
  <section class="fv js-fv">
    <div class="fv__inner">
      <div class="fv__title-wrap site-title">
        <h2 class="site-title__main">diving</h2>
        <p class="site-title__sub">
          into the ocean
        </p>
      </div>

      <!-- 画像スライダー表示(複数枚設定時) -->
      <div class="fv__swiper swiper js-fv-swiper">
        <div class="fv__swiper-wrap swiper-wrapper">
          <?php
            $slideItems = SCF::get('top_slider');
            foreach ($slideItems as $item) :
              $imgUrlPc = wp_get_attachment_image_src( $item['slide_img_pc'], 'full' );
              $imgUrlSp = wp_get_attachment_image_src( $item['slide_img_sp'], 'full' );
          ?>
          <div class="fv__swiper-img swiper-slide">
            <!-- SP・PCどちらも画像がある場合は画面幅により出し分け -->
            <?php if ( $imgUrlPc && $imgUrlSp ) : ?>
            <picture>
              <source srcset="<?php echo esc_url( $imgUrlPc[0] ); ?>" media="(min-width: 768px)">
              <img src="<?php echo esc_url( $imgUrlSp[0] ); ?>" alt="" width="375" height="667" decoding="async">
            </picture>
            <!-- SP・PCどちらかの画像がない場合はある方の画像を使用 -->
            <?php elseif ( $imgUrlPc && !$imgUrlSp ) : ?>
            <img src="<?php echo esc_url( $imgUrlPc[0] ); ?>" alt="" width="1440" height="768" decoding="async">
            <?php elseif ( !$imgUrlPc && $imgUrlSp ) : ?>
            <img src="<?php echo esc_url( $imgUrlSp[0] ); ?>" alt="" width="375" height="667" decoding="async">
            <!-- 画像が1枚もない場合はローディング用の画像を表示 -->
            <?php else : ?>
            <picture>
              <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv1-pc@2x.jpg' ); ?>"
                media="(min-width: 768px)">
              <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv1-sp@2x.jpg' ); ?>" alt="" width="375"
                height="667" decoding="async">
            </picture>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- セクション：キャンペーン(Campaign) -->
  <section class="campaign top-campaign">
    <div class="top-campaign__inner inner">
      <div class="top-campaign__heading section-heading">
        <p class="section-heading__en">campaign</p>
        <h2 class="section-heading__ja">キャンペーン</h2>
      </div>
      <div class="top-campaign__slider">
        <div class="top-campaign__swiper-btn">
          <div class="top-campaign__btn-prev js-campaign-arrow"></div>
          <div class="top-campaign__btn-next js-campaign-arrow"></div>
        </div>
        <div class="top-campaign__swiper swiper js-campaign-swiper">
          <!-- swiper：必須class名 -->
          <ul class="top-campaign__slider-list campaign-list swiper-wrapper">
            <!-- swiper-wrapper：必須class名のため変更不可 -->
            <!-- 記事のループ処理開始(サブループ) -->
            <?php
              $args = [
                'post_type' => 'campaign', // カスタム投稿タイプのスラッグ
                'posts_per_page' => -1, // 表示件数
              ];
              $the_query = new WP_Query( $args );
              if ( $the_query->have_posts() ) :
              while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <li class="campaign-list__item campaign-card swiper-slide">
              <!-- swiper-slide：必須class名のため変更不可 -->
              <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>" class="campaign-card__wrap">
                <!-- アイキャッチ画像(ユーザー画像) -->
                <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
                <figure class="campaign-card__img">
                  <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>のアイキャッチ画像"
                    width="520" height="347" loading="lazy" decoding="async">
                </figure>
                <?php else:?>
                <figure class="campaign-card__img">
                  <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage-user.jpg' ); ?>"
                    alt="no image" width="520" height="347" loading="lazy" decoding="async">
                </figure>
                <?php endif;?>
                <div class="campaign-card__content">
                  <!-- カタクソノミークソノミー) -->
                  <?php
                    $campaign_terms = get_the_terms( $post->ID, 'campaign_category' );
                    $campaign_cat = $campaign_terms[0]->name;
                    if ( $campaign_terms ):
                  ?>
                  <p class="campaign-card__category category-label">
                    <?php echo esc_html( $campaign_cat ); ?>
                  </p>
                  <?php endif;?>
                  <!-- タイトル -->
                  <h3 class="campaign-card__title">
                    <?php the_title(); ?>
                  </h3>
                  <div class="campaign-card__bottom">
                    <p class="campaign-card__text">
                      全部コミコミ(お一人様)
                    </p>
                    <!-- 価格 -->
                    <div class="campaign-card__price">
                      <?php
                        // グループフィールドを取得
                        $campaignPrice = get_field('campaign_price');
                        // グループフィールド内の「通常価格」フィールドを取得
                        $originalPrice = $campaignPrice['original_price'];
                        // グループフィールド内の「キャンペーン価格」フィールドを取得
                        $cutPrice = $campaignPrice['cut_price'];
                      ?>
                      <?php if ( $originalPrice ): ?>
                      <p class="campaign-card__original-price">
                        &yen;<?php echo esc_html( number_format($originalPrice) ); ?>
                      </p>
                      <?php endif;?>
                      <?php if ( $cutPrice ): ?>
                      <p class="campaign-card__cut-price">
                        &yen;<?php echo esc_html( number_format($cutPrice) ); ?>
                      </p>
                      <?php endif;?>
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <?php endwhile; else: ?>
            <p>キャンペーン記事がありません</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            <!-- 記事のループ処理終了 -->
          </ul>
        </div>
      </div>
      <div class="top-campaign__btn">
        <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>" class="button">
          <div></div><span>view more</span>
        </a>
      </div>
    </div>
  </section>

  <!-- セクション：私たちについて(About us) -->
  <section class="about top-about">
    <div class="top-about__inner inner">
      <div class="top-about__heading section-heading">
        <p class="section-heading__en">about us</p>
        <h2 class="section-heading__ja">私たちについて</h2>
      </div>
      <div class="top-about__content about-content">
        <div class="about-content__images">
          <div class="about-content__img about-content__img--left">
            <picture>
              <source media="(min-width:768px)"
                srcset="<?php echo esc_url( get_theme_file_uri().'/images/about/about-left-pc@2x.jpg' ); ?>">
              <img src="<?php echo esc_url( get_theme_file_uri().'/images/about/about-left-sp@2x.jpg' ); ?>"
                alt="青空の下に見える瓦屋根の上のシーサー" width="128" height="194" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="about-content__img about-content__img--right">
            <picture>
              <source media="(min-width:768px)"
                srcset="<?php echo esc_url( get_theme_file_uri().'/images/about/about-right-pc@2x.jpg' ); ?>">
              <img src="<?php echo esc_url( get_theme_file_uri().'/images/about/about-right-sp@2x.jpg' ); ?>"
                alt="海底付近を泳いでいる2匹の黄色い魚" width="281" height="186" loading="lazy" decoding="async">
            </picture>
          </div>
        </div>
        <div class="about-content__text-content">
          <h3 class="about-content__title">Dive into<br>the Ocean</h3>
          <div class="about-content__textarea">
            <div class="about-content__text">
              <?php
                $page_id = get_page_by_path('about-us'); //固定ページのスラッグ名
                $page = get_post( $page_id );
                $content = $page -> post_content;  //固定ページの本文を取得
                echo apply_filters('the_content', $content);
              ?>
            </div>
            <div class="about-content__btn">
              <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>" class="button">
                <div></div><span>view more</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- セクション：ダイビング情報(Information) -->
  <section class="information top-info">
    <div class="top-info__inner inner">
      <div class="top-info__heading section-heading">
        <p class="section-heading__en">information</p>
        <h2 class="section-heading__ja">ダイビング情報</h2>
      </div>
      <div class="top-info__container">
        <div class="top-info__img colorbox">
          <picture>
            <source media="(min-width:768px)"
              srcset="<?php echo esc_url( get_theme_file_uri().'/images/top/info-top-pc@2x.jpg' ); ?>">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/top/info-top-sp@2x.jpg' ); ?>"
              alt="サンゴ礁の中を泳ぐ複数の魚たち" width="345" height="227" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="top-info__text-content">
          <h3 class="top-info__title">ライセンス講習</h3>
          <p class="top-info__text">
            当店はダイビングライセンス（Cカード）世界最大の教育機関PADIの「正規店」として店舗登録されています。<br>
            正規登録店として、安心安全に初めての方でも安心安全にライセンス取得をサポート致します。
          </p>
          <div class="top-info__btn">
            <a href="<?php echo esc_url( home_url( '/information' ) ); ?>" class="button">
              <div></div><span>view more</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- セクション：ブログ(Blog) -->
  <section class="blog top-blog" id="top-blog">
    <div class="top-blog__inner inner">
      <div class="top-blog__heading section-heading">
        <p class="section-heading__en section-heading__en--white">blog</p>
        <h2 class="section-heading__ja section-heading__ja--white">ブログ</h2>
      </div>
      <ul class="top-blog__list blog-list">
        <!-- 記事のループ処理開始(サブループ) -->
        <?php
          $args = [
            'post_type' => 'post', // 投稿タイプのスラッグ(通常投稿は'post')
            'posts_per_page' => 3, // 表示件数
          ];
          $the_query = new WP_Query( $args );
          if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <li class="blog-list__item blog-card">
          <a href="<?php the_permalink(); ?>">
            <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
            <figure class="blog-card__img">
              <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>のアイキャッチ画像"
                width="301" height="201" loading="lazy" decoding="async">
            </figure>
            <?php else:?>
            <figure class="blog-card__img">
              <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>" alt="no image"
                width="301" height="201" loading="lazy" decoding="async">
            </figure>
            <?php endif;?>
            <div class="blog-card__content">
              <time class="blog-card__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.n/j'); ?></time>
              <h3 class="blog-card__title"><?php the_title(); ?></h3>
              <p class="blog-card__text"><?php the_excerpt(); ?></p>
            </div>
          </a>
        </li>
        <?php endwhile; else: ?>
        <p>まだ記事がありません</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        <!-- 記事のループ処理終了 -->
      </ul>
      <div class="top-blog__btn">
        <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="button">
          <div></div><span>view more</span>
        </a>
      </div>
    </div>
  </section>

  <!-- セクション：お客様の声(Voice) -->
  <section class="voice top-voice" id="top-voice">
    <div class="top-voice__inner inner">
      <div class="top-voice__heading section-heading">
        <p class="section-heading__en">voice</p>
        <h2 class="section-heading__ja">お客様の声</h2>
      </div>
      <ul class="top-voice__list voice-list">
        <!-- 記事のループ処理開始(サブループ) -->
        <?php
          $args = [
            'post_type' => 'voice', // カスタム投稿タイプのスラッグ
            'posts_per_page' => 2, // 表示件数
          ];
          $the_query = new WP_Query( $args );
          if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <li class="voice-list__item voice-card">
          <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>" class="voice-card__wrap">
            <div class="voice-card__info">
              <div class="voice-card__infoBox">
                <div class="voice-card__user">
                  <?php
                    // グループフィールドを取得
                    $voiceUser = get_field('voice_user');
                    // グループフィールド内の「年代」フィールドを取得
                    $userAge = $voiceUser['user_age'];
                    // グループフィールド内の「性別」フィールドを取得
                    $userGender = $voiceUser['user_gender'];
                  ?>
                  <p class="voice-card__age-gender">
                    <?php if ( $userAge ){
                      echo esc_html( ($userAge) );
                    } ?>
                    (<?php if ( $userGender ){
                      echo esc_html( ($userGender) );
                    } ?>)
                  </p>
                  <!-- カテゴリー(タクソノミー) -->
                  <?php
                    $voice_terms = get_the_terms( $post->ID, 'voice_category' );
                    $voice_cat = $voice_terms[0]->name;
                    if ( $voice_terms ):
                  ?>
                  <p class="voice-card__category category-label">
                    <?php echo esc_html( $voice_cat ); ?>
                  </p>
                  <?php endif;?>
                </div>
                <!-- タイトル -->
                <h3 class="voice-card__title voice-card__title--row-limit">
                  <?php the_title(); ?>
                </h3>
              </div>
              <!-- アイキャッチ画像(ユーザー画像) -->
              <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
              <figure class="voice-card__img colorbox">
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>のアイキャッチ画像"
                  width="180" height="140" loading="lazy" decoding="async">
              </figure>
              <?php else:?>
              <figure class="voice-card__img">
                <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage-user.jpg' ); ?>"
                  alt="no image" width="301" height="201" loading="lazy" decoding="async">
              </figure>
              <?php endif;?>
            </div>
            <!-- 本文 -->
            <div class="voice-card__text voice-card__text--row-limit">
              <?php the_content(); ?>
            </div>
          </a>
        </li>
        <?php endwhile; else: ?>
        <p>まだ記事がありません</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        <!-- 記事のループ処理終了 -->
      </ul>
      <div class="top-voice__btn">
        <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>" class="button">
          <div></div><span>view more</span>
        </a>
      </div>
    </div>
  </section>

  <!-- セクション：料金一覧(Price) -->
  <section class="price top-price">
    <div class="top-price__inner inner">
      <div class="top-price__heading section-heading">
        <p class="section-heading__en">price</p>
        <h2 class="section-heading__ja">料金一覧</h2>
      </div>
      <div class="top-price__content">
        <div class="top-price__img colorbox">
          <picture>
            <source media="(min-width:768px)"
              srcset="<?php echo esc_url( get_theme_file_uri().'/images/top/price-top-pc@2x.jpg' ); ?>">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/top/price-top-sp@2x.jpg' ); ?>" alt="海中を泳ぐウミガメ"
              width="345" height="227" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="top-price__list price-list">
          <!-- ライセンス講習コース料金表(SCF) -->
          <?php
            $priceLicense = SCF::get('price_license','35');
            if ( $priceLicense ) :
          ?>
          <div class="price-list__block">
            <h3 class="price-list__title">ライセンス講習</h3>
            <dl class="price-list__item">
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
            $priceFundiving = SCF::get('price_fundiving','35');
            if ( $priceFundiving ) :
          ?>
          <div class="price-list__block">
            <h3 class="price-list__title">体験ダイビング</h3>
            <dl class="price-list__item">
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
            $priceExperience = SCF::get('price_experience','35');
            if ( $priceExperience ) :
          ?>
          <div class="price-list__block">
            <h3 class="price-list__title">ファンダイビング</h3>
            <dl class="price-list__item">
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
            $priceSpdiving = SCF::get('price_spdiving','35');
            if ( $priceSpdiving ) :
          ?>
          <div class="price-list__block">
            <h3 class="price-list__title">スペシャルダイビング</h3>
            <dl class="price-list__item">
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

          <!-- 新しいコースを追加する場合(CFS) -->
          <?php
            $priceNew = CFS()->get('price_new', 35);
            if ( is_array($priceNew) ):
              foreach( $priceNew as $newItem ) :
                $newTitle = $newItem['price_new_title'];
          ?>
          <div class="price-list__block">
            <h3 class="price-list__title">
              <?php echo esc_html( $newTitle ); ?>
            </h3>
            <?php
              $priceNewContent = $newItem['price_new_content'];
              if ( is_array($priceNewContent) ):
            ?>
            <dl class="price-list__item">
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
      <div class="top-price__btn">
        <a href="<?php echo esc_url( home_url( '/price' ) ); ?>" class="button">
          <div></div><span>view more</span>
        </a>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>