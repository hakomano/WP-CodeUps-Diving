<?php get_header(); ?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Campaign</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-campaign-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-campaign-sp@2x.jpg' ); ?>" alt=""
          width="375" height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- キャンペーンタブ -->
  <div class="sub-campaign sub-layout">
    <div class="sub-campaign__inner inner">
      <div class="sub-campaign__bg sub-bg">
        <!-- キャンペーンカテゴリー(ターム)を全部表示 -->
        <ul class="sub-campaign__tab tab-menu">
          <li class="tab-menu__item">
            <a href=" <?php echo esc_url( get_post_type_archive_link( 'campaign' ) ); ?>">all</a>
          </li>
          <?php
            $taxonomy_terms = get_terms( 'campaign_category', array( 'orderby' => 'description' ) );
            if ( !empty($taxonomy_terms)&&!is_wp_error($taxonomy_terms) ):
              foreach ( $taxonomy_terms as $taxonomy_term ):
          ?>
          <li class="tab-menu__item <?php if ( $taxonomy_term->slug === $term ){ echo 'current'; } ?>">
            <a href="<?php echo get_term_link( $taxonomy_term ); ?>">
              <?php echo $taxonomy_term->name; ?>
            </a>
          </li>
          <?php endforeach; endif;?>
        </ul>

        <div class="sub-campaign__tab-content">
          <ul class="sub-campaign__list campaign-list campaign-list--2col">
            <!-- 記事のループ処理開始 -->
            <?php
              if ( have_posts() ): while ( have_posts() ): the_post();
            ?>
            <li class="campaign-list__item campaign-card">
              <div class="campaign-card__wrap">
                <!-- アイキャッチ画像 -->
                <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
                <figure class="campaign-card__img">
                  <img src="<?php esc_url( the_post_thumbnail_url('full') ); ?>"
                    alt="<?php the_title_attribute(); ?>のアイキャッチ画像" width="520" height="347" loading="lazy"
                    decoding="async">
                </figure>
                <?php else:?>
                <figure class="blog-card__img">
                  <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>" alt="no image"
                    width="301" height="201" loading="lazy" decoding="async">
                </figure>
                <?php endif;?>
                <div class="campaign-card__content campaign-card__content--sub">
                  <!-- カテゴリー -->
                  <?php
                    $campaign_terms = get_the_terms( $post->ID, 'campaign_category' );
                    $campaign_cat = $campaign_terms[0]->name;
                    if ( $campaign_terms ):
                  ?>
                  <p class="campaign-card__category category-label">
                    <?php echo esc_html( $campaign_cat ); ?>
                  </p>
                  <?php endif;?>
                  <h2 class="campaign-card__title campaign-card__title--sub">
                    <?php the_title(); ?>
                  </h2>
                  <div class="campaign-card__bottom">
                    <p class="campaign-card__text campaign-card__text--sub">
                      全部コミコミ(お一人様)
                    </p>
                    <!-- 価格 -->
                    <div class="campaign-card__price campaign-card__price--sub">
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
                  <div class="campaign-card__sub-bottom u-desktop">
                    <!-- 本文 -->
                    <div class="campaign-card__description">
                      <?php
                        echo apply_filters( 'the_content', get_the_content() );
                      ?>
                    </div>
                    <!-- キャンペーン期間 -->
                    <div class="campaign-card__period">
                      <?php
                        // グループフィールドを取得
                        $campaignPeriod = get_field('campaign_period');
                        // グループフィールド内の「開始日」フィールドを取得
                        $startDate = $campaignPeriod['start_date'];
                        // グループフィールド内の「終了日」フィールドを取得
                        $endDate = $campaignPeriod['end_date'];
                        //開始日と終了日から年を取得
                        $startYear = date('Y', strtotime($startDate));
                        $endYear = date('Y', strtotime($endDate));
                      ?>
                      <?php if ( $startDate ): ?>
                      <time datetime="<?php echo esc_html( $startDate ); ?>">
                        <?php echo esc_html( date('Y.n/j', strtotime($startDate)) ); ?>
                      </time>
                      <?php endif;?>
                      <?php if ( $endDate ): ?>
                      - <time datetime="<?php echo esc_html( $endDate ); ?>">
                        <!-- 同じ年なら年を非表示に -->
                        <?php if ( $startYear === $endYear ) {
                          echo esc_html( date('n/j', strtotime($endDate)) );
                        } else {
                          echo esc_html( date('Y.n/j', strtotime($endDate)) );
                        } ?>
                      </time>
                      <?php endif;?>
                    </div>
                    <p class="campaign-card__cta-text">
                      ご予約・お問い合わせはコチラ
                    </p>
                    <div class="campaign-card__btn">
                      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="button">
                        <div></div><span>contact us</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endwhile; else: ?>
            <p>まだ記事がありません</p>
            <?php endif; ?>
            <!-- 記事のループ処理終了 -->
          </ul>

          <!-- ページネーション -->
          <?php get_template_part('parts/pagenavi') ?>
        </div>

      </div>
    </div>
  </div>

  <?php get_footer(); ?>