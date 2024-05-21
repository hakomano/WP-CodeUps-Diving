<aside class="sidebar">
  <!-- ブログの人気記事３件 ※View数(アクセス数)がない場合この項目ごと非表示 -->
  <?php
    $loopcounter = 0;

    $args = array(
      'post_type' => 'post',
      'meta_key'=> 'post_views_count',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
      'posts_per_page' => 3,
    );
    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ):
  ?>
  <section class="sidebar__block popular-blog">
    <h2 class="popular-blog__title sidebar-title">人気記事</h2>
    <ul class="popular-blog__list sidebar-list-layout">
      <?php
        while ( $the_query->have_posts() ): $the_query->the_post();
        $loopcounter++;
      ?>
      <li class="popular-blog__item blog-mini-card">
        <a href="<?php the_permalink(); ?>">
          <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
          <figure class="blog-mini-card__img">
            <img src="<?php esc_url( the_post_thumbnail_url('full') ); ?>"
              alt="<?php the_title_attribute(); ?>のアイキャッチ画像" width="121" height="90" loading="lazy" decoding="async">
          </figure>
          <?php else:?>
          <figure class="blog-mini-card__img">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>" alt="no image"
              width="121" height="90" loading="lazy" decoding="async">
          </figure>
          <?php endif;?>
          <div class="blog-mini-card__content">
            <time class="blog-mini-card__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.n/j'); ?></time>
            <h3 class="blog-mini-card__title"><?php the_title(); ?></h3>
          </div>
        </a>
      </li>
      <?php endwhile; ?>
    </ul>
  </section>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>

  <!-- お客様の声から最新1件表示 ※投稿記事がない場合この項目ごと非表示 -->
  <?php
    $args = array(
      'post_type' => 'voice',
      'posts_per_page' => 1,
    );
    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ):
  ?>
  <section class="sidebar__block pickup-voice">
    <h2 class="pickup-voice__title sidebar-title">口コミ</h2>
    <ul class="pickup-voice__list sidebar-list-layout">
      <?php
        while ( $the_query->have_posts() ): $the_query->the_post();
      ?>
      <li class="pickup-voice__item voice-mini-card">
        <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>">
          <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
          <figure class="voice-mini-card__img">
            <img src="<?php esc_url( the_post_thumbnail_url('full') ); ?>"
              alt="<?php the_title_attribute(); ?>のアイキャッチ画像" width="294" height="218" loading="lazy" decoding="async">
          </figure>
          <?php else:?>
          <figure class="voice-mini-card__img">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage-user.jpg' ); ?>" alt="no image"
              width="294" height="218" loading="lazy" decoding="async">
          </figure>
          <?php endif;?>
          <div class="voice-mini-card__content">
            <?php
              // グループフィールドを取得
              $voiceUser = get_field('voice_user');
              // グループフィールド内の「年代」フィールドを取得
              $userAge = $voiceUser['user_age'];
              // グループフィールド内の「性別」フィールドを取得
              $userGender = $voiceUser['user_gender'];
            ?>
            <p class="voice-mini-card__age-gender">
              <?php if ( $userAge ){
                echo esc_html( ($userAge) );
              } ?>
              (<?php if ( $userGender ){
                echo esc_html( ($userGender) );
              } ?>)
            </p>
            <h3 class="voice-mini-card__title">
              <?php the_title(); ?>
            </h3>
          </div>
        </a>
      </li>
      <?php endwhile; ?>
    </ul>
    <div class="pickup-voice__btn">
      <a href="<?php echo esc_url( home_url( '/voice' ) ); ?>" class="button">
        <div></div><span>view more</span>
      </a>
    </div>
  </section>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>

  <!-- キャンペーンから最新2件表示 ※投稿記事がない場合この項目ごと非表示 -->
  <?php
    $args = array(
      'post_type' => 'campaign',
      'posts_per_page' => 2,
    );
    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ):
  ?>
  <section class="sidebar__block pickup-campaign">
    <h2 class="pickup-campaign__title sidebar-title">キャンペーン</h2>
    <ul class="pickup-campaign__list sidebar-list-layout">
      <?php
        while ( $the_query->have_posts() ): $the_query->the_post();
      ?>
      <li class="pickup-campaign__item campaign-mini-card">
        <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>">
          <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
          <figure class="campaign-mini-card__img">
            <img src="<?php esc_url( the_post_thumbnail_url('full') ); ?>"
              alt="<?php the_title_attribute(); ?>のアイキャッチ画像" width="294" height="188" loading="lazy" decoding="async">
          </figure>
          <?php else:?>
          <figure class="campaign-mini-card__img">
            <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>" alt="no image"
              width="294" height="188" loading="lazy" decoding="async">
          </figure>
          <?php endif;?>
          <div class="campaign-mini-card__content">
            <h3 class="campaign-mini-card__title">
              <?php the_title(); ?>
            </h3>
            <div class="campaign-mini-card__bottom">
              <p class="campaign-mini-card__text">
                全部コミコミ(お一人様)
              </p>
              <div class="campaign-mini-card__price">
                <?php
                  // グループフィールドを取得
                  $campaignPrice = get_field('campaign_price');
                  // グループフィールド内の「通常価格」フィールドを取得
                  $originalPrice = $campaignPrice['original_price'];
                  // グループフィールド内の「キャンペーン価格」フィールドを取得
                  $cutPrice = $campaignPrice['cut_price'];
                ?>
                <?php if ( $originalPrice ): ?>
                <p class="campaign-mini-card__original-price">
                  &yen;<?php echo esc_html( number_format($originalPrice) ); ?>
                </p>
                <?php endif;?>
                <?php if ( $cutPrice ): ?>
                <p class="campaign-mini-card__cut-price">
                  &yen;<?php echo esc_html( number_format($cutPrice) ); ?>
                </p>
                <?php endif;?>
              </div>
            </div>
          </div>
        </a>
      </li>
      <?php endwhile; ?>
    </ul>
    <div class="pickup-campaign__btn">
      <a href="<?php echo esc_url( home_url( '/campaign' ) ); ?>" class="button">
        <div></div><span>view more</span>
      </a>
    </div>
  </section>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>

  <!-- 年ごとに分けて月別アーカイブ一覧 -->
  <section class="sidebar__block sidebar-archive">
    <h2 class="sidebar-archive__title sidebar-title">アーカイブ</h2>
    <ul class="sidebar-archive__list sidebar-list-layout">
      <!-- 年ごとに分けて月を表示する -->
      <?php
        // 投稿年ごとにグループ化
        $blog_by_year = array();
        $args = array(
          'post_type' => 'post',
          'post_status' => 'publish', //公開状態
          'posts_per_page' => -1, //全ての投稿
        );
        $the_query = new WP_Query($args);
        if ( $the_query->have_posts() ):
        while ( $the_query->have_posts() ): $the_query->the_post();
            $year = get_the_date('Y'); //投稿の年を取得
            $month = get_the_date('n'); //投稿の月を取得(0無:表示用)
            $blog_by_year[$year][$month][] = $post; //投稿を格納
        endwhile;
        endif;
        wp_reset_postdata();

        // 投稿年でループ
        foreach ( $blog_by_year as $year => $years ) :
      ?>
      <li class="sidebar-archive__year">
        <p class="js-archive-toggle"><?php echo esc_html( $year ); ?></p>
        <ul class="sidebar-archive__list-months">
          <?php
            // 投稿をループ
            foreach ( $years as $month => $blog ) :
              setup_postdata($post);
          ?>
          <li>
            <?php $month2 = str_pad( $month, 2, "0", STR_PAD_LEFT ); //2桁でなければ先頭に0を付ける:リンク用 ?>
            <a href="<?php echo esc_url( home_url($year.'/'.$month2.'/') ); ?>">
              <?php echo esc_html( $month ); ?>月
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>
</aside>