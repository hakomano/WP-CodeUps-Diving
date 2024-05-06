<?php
  /*=================================================================
      標準機能セットアップ
  ==================================================================*/
  function my_theme_setup(){
    add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
    add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
    add_theme_support('title-tag'); // titleタグ自動生成
    add_theme_support('html5', array( // HTML5による出力
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'script',
      'style',
    ));
  }
  add_action('after_setup_theme', 'my_theme_setup');


  /*=================================================================
      CSS・JavaScript・jQuery・Swiper・Fontの読み込み
  ==================================================================*/
  function my_theme_script_init(){
    // WordPressに含まれているjquery.jsを読み込まない
    wp_deregister_script('jquery');
    // jQueryの読み込み(注：バージョンアップ)
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.6.0.js', array(), "3.6.0", true);
    // Swiperの読み込み(注：バージョンアップ)
    wp_enqueue_style( 'swiper-style', '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11' );
    wp_enqueue_script( 'swiper-script', '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true );
    // Google Fontsの読み込み(2つ以上ある場合は1つずつ書く)
    wp_enqueue_style( 'font-NotoSansJp', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap' );
    wp_enqueue_style( 'font-Gotu', '//fonts.googleapis.com/css2?family=Gotu&display=swap' );
    wp_enqueue_style( 'font-Lato', '//fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap' );
    // inviewの読み込み
    wp_enqueue_script( 'inview-js', get_theme_file_uri('/js/jquery.inview.min.js'), array('jquery') , null, true );
    // CSSの読み込み
    wp_enqueue_style( 'style-css', get_theme_file_uri('/css/style.css') , array(), '1.0.0' );
    // 自作jsの読み込み(ページにより出し分け)
    if(is_front_page()){
      wp_enqueue_script( 'main-js', get_theme_file_uri('/js/script.js'), array('jquery') , '1.0.0', true );
    }elseif(is_page('contact')){
      wp_enqueue_script( 'contact-js', get_theme_file_uri('/js/script-contact.js'), array('jquery') , '1.0.0', true );
    }else{
      wp_enqueue_script( 'simple-js', get_theme_file_uri('/js/script-simple.js'), array('jquery') , '1.0.0', true );
    }
  }
  add_action('wp_enqueue_scripts', 'my_theme_script_init');


  /*=================================================================
      記事表示時の整形無効(自動的な改行挿入を取り除く)
  ==================================================================*/
  function my_theme_remove_wpautop() {
    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_excerpt', 'wpautop' );

    add_filter( 'tiny_mce_before_init', 'my_theme_disable_tinymce_formatting' );
  }
  add_action( 'after_setup_theme', 'my_theme_remove_wpautop' );

  // 抜粋の省略記号を「…」に変更する
  add_filter( 'excerpt_more', function( $more ){
    return '&hellip;';
  }, 999 );

  // 抜粋の文字数制限を110から200に変更
  add_filter( 'excerpt_length', function( $length ){
    return 150;
  }, 999 );


  /*=================================================================
      ビジュアルエディタ(TinyMCE)の整形無効
  ==================================================================*/
  function my_theme_disable_tinymce_formatting( $init_array ) {
    global $allowedposttags;

    $init_array['valid_elements']          = '*[*]';
    $init_array['extended_valid_elements'] = '*[*]';
    $init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
    $init_array['indent']                  = true;
    $init_array['wpautop']                 = false;
    $init_array['force_p_newlines']        = false;

    return $init_array;
  }

  /*=================================================================
      投稿のラベルを変更
  ==================================================================*/
  function change_post_menu_label() {
    global $menu;
    global $submenu;
      $name = 'ブログ';
    $menu[5][0] = $name;
    $submenu['edit.php'][5][0] = $name.'一覧';
    $submenu['edit.php'][10][0] = '新しい'.$name.'を追加';
  }
  function change_post_object_label() {
    global $wp_post_types;
    $name = 'ブログ';
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $name;
    $labels->singular_name = $name;
    $labels->add_new = _x('新規追加', $name);
    $labels->add_new_item = $name.'の新規追加';
    $labels->edit_item = $name.'の編集';
    $labels->new_item = '新規'.$name;
    $labels->view_item = $name.'を表示';
    $labels->search_items = $name.'を検索';
    $labels->not_found = $name.'が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に'.$name.'は見つかりませんでした';
  }
  add_action( 'init', 'change_post_object_label' );
  add_action( 'admin_menu', 'change_post_menu_label' );


  /*=================================================================
      サイドバー：人気記事の表示(プラグイン不使用)
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

  /*管理画面のカラムを追加*/
  function manage_posts_columns($columns) {
    $columns['post_views_count'] = 'view数';
    $columns['thumbnail'] = 'サムネイル';

    return $columns;
  }
  add_filter('manage_posts_columns', 'manage_posts_columns');

  /*アクセス数を出力*/
  function add_column($column_name, $post_id) {
    /*View数呼び出し*/
    if ($column_name === 'post_views_count') {
      $pv = get_post_meta($post_id, 'post_views_count', true);
    }

    /*サムネイル呼び出し*/
    if ($column_name === 'thumbnail') {
      $thumb = get_the_post_thumbnail($post_id, array(100, 100), 'thumbnail');
    }

    /*ない場合は「なし」を表示する*/
    if (isset($pv) && $pv) {
      echo attribute_escape($pv);
    } elseif (isset($thumb) && $thumb) {
      echo $thumb;
    } else {
      echo __('None');
    }
  }
  add_action('manage_posts_custom_column', 'add_column', 10, 2);