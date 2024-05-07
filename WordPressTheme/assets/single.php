<?php get_header(); ?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <div class="sub-fv__title">Blog</div>
    <div class="sub-fv__img">
      <picture>
        <source srcset="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-blog-pc@2x.jpg' ); ?>"
          media="(min-width: 768px)">
        <img src="<?php echo esc_url( get_theme_file_uri().'/images/fv/fv-sub-blog-sp@2x.jpg' ); ?>" alt="" width="375"
          height="460" decoding="async">
      </picture>
    </div>
  </section>
  <!-- パンくずリスト(共通パーツ化) -->
  <?php get_template_part('parts/breadcrumb') ?>

  <!-- ブログ記事(サイドバーありの２カラムレイアウト) -->
  <div class="columns-layout sub-layout">
    <div class="columns-layout__inner inner">
      <div class="columns-layout__bg sub-bg">
        <div class="columns-layout__container">
          <div class="columns-layout__main">
            <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
            <article class="columns-layout__article single-blog">
              <time class="single-blog__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.n/j'); ?></time>
              <h1 class="single-blog__title"><?php the_title(); ?></h1>
              <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
              <div class="single-blog__thumbnail">
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>のアイキャッチ画像"
                  width="345" height="231" loading="lazy" decoding="async">
              </div>
              <?php else:?>
              <div class="single-blog__thumbnail">
                <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>" alt="no image"
                  width="345" height="231" loading="lazy" decoding="async">
              </div>
              <?php endif;?>
              <div class="single-blog__article-content">
                <?php the_content(); ?>
              </div>
            </article>
            <?php endwhile; endif; ?>

            <!-- 前後ページネーション -->
            <div class=" sub-single-blog__pagenavi post-link">
              <div class="post-link__inner">
                <div class="post-link__prev-next">
                  <?php
                    $prev = get_previous_post();
                    if ( !empty($prev) ){
                      $prev_url = esc_url(get_permalink($prev->ID));
                    }

                    $next = get_next_post();
                    if ( !empty($next) ){
                      $next_url = esc_url(get_permalink($next->ID));
                    }
                  ?>
                  <div class="post-link__prev">
                    <?php if ( !empty($prev) ): ?>
                    <a href="<?php echo $prev_url; ?>">＜</a>
                    <?php endif; ?>
                  </div>
                  <div class="post-link__next">
                    <?php if ( !empty($next) ): ?>
                    <a href="<?php echo $next_url; ?>">＞</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- サイドバー -->
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>