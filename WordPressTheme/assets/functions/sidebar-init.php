<?php
  /*=================================================================
      サイドバーの人気記事の表示(プラグイン不使用)
  ==================================================================*/
  //クローラーのアクセス判別
  function is_bot() {
    $ua = $_SERVER['HTTP_USER_AGENT'];

    $bot = array(
          "googlebot",
          "msnbot",
          "yahoo"
    );

    foreach( $bot as $bot ) {
      if (stripos( $ua, $bot ) !== false){
        return true;
      }
    }
    return false;
  }

  //アクセス数を保存
  function set_post_views() {
    if(!is_user_logged_in() && !is_bot()) {
      if(is_single()) {
        $post_id = get_the_ID();
        $count_key = 'post_views_count';
        $count = get_post_meta($post_id, $count_key, true);

        if(empty($count)) {
          delete_post_meta($post_id, $count_key);
          add_post_meta($post_id, $count_key, 1);
        } else {
          $count = $count + 1;
          update_post_meta($post_id, $count_key, $count);
        }
      }
    }
  }
  add_action('wp_head', 'set_post_views');

  /* 管理画面のカラムを追加 */
  function manage_posts_columns($columns) {
    $columns['post_views_count'] = 'view数';
    $columns['thumbnail'] = 'アイキャッチ';

    return $columns;
  }
  add_filter('manage_posts_columns', 'manage_posts_columns');

  /* アクセス数を出力 */
  function add_column($column_name, $post_id) {
    /* View数呼び出し */
    if ($column_name === 'post_views_count') {
      $pv = get_post_meta($post_id, 'post_views_count', true);
    }

    /* アイキャッチ呼び出し */
    if ($column_name === 'thumbnail') {
      $thumb = get_the_post_thumbnail($post_id, array(100, 100), 'thumbnail');
    }

    /* 表示 */
    if (isset($pv) && $pv) {
      echo attribute_escape($pv);
    } elseif (isset($thumb) && $thumb) {
      echo $thumb;
    // } else {
    //   echo __('None');
    }
  }
  add_action('manage_posts_custom_column', 'add_column', 10, 2);