<?php get_header(); ?>

<main>
  <!-- 下層ファーストビュー -->
  <section class="sub-fv">
    <h1 class="sub-fv__title">Blog</h1>
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

  <!-- ブログ一覧 -->
  <div class="columns-layout sub-layout">
    <div class="columns-layout__inner inner">
      <div class="columns-layout__bg sub-bg">
        <div class="columns-layout__container">
          <div class="columns-layout__main">
            <ul class="columns-layout__list blog-list blog-list--2col">
              <!-- 記事のループ処理開始 -->
              <?php
                if ( have_posts() ): while ( have_posts() ): the_post();
              ?>
              <li class="blog-list__item blog-card">
                <a href="<?php the_permalink(); ?>">
                  <?php if ( !empty(get_the_post_thumbnail_url()) ):?>
                  <figure class="blog-card__img">
                    <img src="<?php the_post_thumbnail_url('full'); ?>"
                      alt="<?php the_title_attribute(); //HTMLを除去してタイトルを取得・表示 ?>のアイキャッチ画像" width="301" height="201"
                      loading="lazy" decoding="async">
                  </figure>
                  <?php else:?>
                  <figure class="blog-card__img">
                    <img src="<?php echo esc_url( get_theme_file_uri().'/images/common/noimage.jpg' ); ?>"
                      alt="no image" width="301" height="201" loading="lazy" decoding="async">
                  </figure>
                  <?php endif;?>

                  <div class="blog-card__content">
                    <time class="blog-card__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.n/j'); ?></time>
                    <h2 class="blog-card__title"><?php the_title(); ?></h2>
                    <p class="blog-card__text"><?php the_excerpt(); ?></p>
                  </div>
                </a>
              </li>
              <?php endwhile; else: ?>
              <p>まだ記事がありません</p>
              <?php endif; ?>
              <!-- 記事のループ処理終了 -->
            </ul>
            <!-- ページネーション -->
            <?php get_template_part('parts/pagenavi') ?>
          </div>

          <!-- サイドバー -->
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>