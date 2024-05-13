<?php get_header(); ?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Voice</h1>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-voice-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-voice-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- お客様の声タブ -->
  <div class="sub-voice sub-layout">
    <div class="sub-voice__inner inner">
      <div class="sub-voice__bg sub-bg">
        <!-- お客様の声カテゴリー(ターム)を全部表示 -->
        <ul class="sub-voice__tab tab-menu">
          <li class="tab-menu__item">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'voice' ) ); ?>">all</a>
          </li>
          <?php
            $taxonomy_terms = get_terms( 'voice_category', array( 'orderby' => 'description' ) );
            if( !empty($taxonomy_terms) && !is_wp_error($taxonomy_terms) ):
              foreach ( $taxonomy_terms as $taxonomy_term ):
          ?>
          <li class="tab-menu__item <?php if ( $taxonomy_term->slug === $term ){ echo 'current'; } ?>">
            <a href="<?php echo get_term_link( $taxonomy_term ); ?>">
              <?php echo $taxonomy_term->name; ?>
            </a>
          </li>
          <?php endforeach; endif;?>
        </ul>

        <div class="sub-voice__tab-content">
          <ul class="sub-voice__list voice-list">
            <!-- 記事のループ処理開始 -->
            <?php
              if ( have_posts() ): while ( have_posts() ): the_post();
            ?>
            <li class="voice-list__item voice-card">
              <div class="voice-card__wrap">
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
                        <?php if($userAge){
                          echo esc_html( $userAge );
                        } ?>
                        (<?php if($userGender){
                          echo esc_html( $userGender );
                        } ?>)
                      </p>
                      <!-- カテゴリー -->
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
                    <h2 class="voice-card__title">
                      <?php the_title(); ?>
                    </h2>
                  </div>
                  <!-- アイキャッチ画像 -->
                  <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
                  <figure class="voice-card__img">
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
                <div class="voice-card__text">
                  <?php the_content(); ?>
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