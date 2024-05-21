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
    /* WordPressに含まれているjquery.jsを読み込まない */
    wp_deregister_script('jquery');
    /* jQueryの読み込み(注：バージョンアップ) */
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.6.0.js', array(), "3.6.0", true);
    /* Swiperの読み込み(注：バージョンアップ) */
    wp_enqueue_style( 'swiper-style', '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11' );
    wp_enqueue_script( 'swiper-script', '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true );
    /* Google Fontsの読み込み(2つ以上ある場合は1つずつ書く) */
    wp_enqueue_style( 'font-NotoSansJp', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap' );
    wp_enqueue_style( 'font-Gotu', '//fonts.googleapis.com/css2?family=Gotu&display=swap' );
    wp_enqueue_style( 'font-Lato', '//fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap' );
    /* inviewの読み込み */
    wp_enqueue_script( 'inview-js', get_theme_file_uri('/js/jquery.inview.min.js'), array('jquery') , null, true );
    /* CSSの読み込み */
    wp_enqueue_style( 'style-css', get_theme_file_uri('/css/style.css') , array(), '1.0.0' );
    /* 自作jsの読み込み(ページにより出し分け) */
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

  /* 抜粋の省略記号を「…」に変更する */
  add_filter( 'excerpt_more', function( $more ){
    return '&hellip;';
  }, 999 );

  /*  抜粋の文字数制限を110から200に変更 */
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