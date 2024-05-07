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
      【管理画面】投稿のラベルを変更
  ==================================================================*/
  function change_post_menu_label() {
    global $menu;
    global $submenu;
    $name = 'ブログ';
    $menu[5][0] = $name; //表記名変更
    $menu[5][6] = "dashicons-edit"; //アイコン変更
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
      【管理画面】サイドメニュー並び順を変更
  ==================================================================*/
  function sort_side_menu( $menu_order ) {
    return array(
      "index.php", // ダッシュボード
      "edit.php", // 投稿(ブログ)
      "edit.php?post_type=campaign", // カスタム投稿(キャンペーン)
      "edit.php?post_type=voice", // カスタム投稿(お客様の声)
      "edit.php?post_type=page", // 固定ページ
      "separator1", // 区切り線1
      "upload.php", // メディア
      "edit-comments.php", // コメント
      "separator2", // 区切り線2
      "options-general.php", // 設定
      "themes.php", // 外観
      "users.php", // ユーザー
      "tools.php", // ツール
      "plugins.php", // プラグイン
      "separator-last" // 区切り線（最後）
    );
  }
  add_filter( 'custom_menu_order', '__return_true' );
  add_filter( 'menu_order', 'sort_side_menu' );

  /*=================================================================
      【管理画面】メディアのラベルを変更
  ==================================================================*/
  function change_menu_label() {
    global $menu, $submenu;
    $menu[10][0] = '画像・ファイル';
    $submenu['upload.php'][5][0] = '画像・ファイル一覧';
    $submenu['upload.php'][10][0] = '画像・ファイルを追加';
  }
  add_action( 'admin_menu', 'change_menu_label' );

  /*=================================================================
      【管理画面】投稿画面のカスタマイズ
  ==================================================================*/
  /* タイトルのプレイスホルダーテキストを変更 */
  function change_default_title( $title ) {
    $screen = get_current_screen();
    if ( $screen->post_type == 'post' ) {
          $title = 'ここにブログのタイトルを入力';
    }
    elseif ( $screen->post_type == 'campaign' ) {
          $title = 'ここにキャンペーン名を入力';
    }
    elseif ( $screen->post_type == 'voice' ) {
          $title = 'ここにお客様の声タイトルを入力';
    }
      return $title;
  }
  add_filter( 'enter_title_here', 'change_default_title' );

  /* 本文プレイスホルダーテキストを変更(クリックしたら戻る) */
  function change_default_placeholder( $text ) {
    $screen = get_current_screen();
    if ( $screen->post_type == 'post' ) {
        $text = 'ここにブログ記事の本文を入力してください ( 画像挿入も可 )';
    }
    elseif ( $screen->post_type == 'campaign' ) {
          $text = 'ここにキャンペーン記事の本文を入力してください';
    }
    elseif ( $screen->post_type == 'voice' ) {
          $text = 'ここにお客様の声記事の本文を入力してください';
    }
      return $text;
  }
  add_filter( 'write_your_story', 'change_default_placeholder', 10, 2 );

  /*=================================================================
      【管理画面】カスタム投稿一覧画面カスタマイズ
  ==================================================================*/
  /* キャンペーン一覧のカテゴリー絞り込みフィルター追加 */
  function add_campaign_taxonomy_restrict_filter() {
    global $post_type;
    if ( 'campaign' == $post_type ) {
    ?>
<select name="campaign_category">
  <option value="">カテゴリー一覧</option>
  <?php
      $terms = get_terms('campaign_category');
      foreach ($terms as $term) { ?>
  <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
  <?php } ?>
</select>
<?php
    }
  }
  add_action( 'restrict_manage_posts', 'add_campaign_taxonomy_restrict_filter' );

  /* お客様の声一覧のカテゴリー絞り込みフィルター追加 */
  function add_voice_taxonomy_restrict_filter() {
    global $post_type;
    if ( 'voice' == $post_type ) {
    ?>
<select name="voice_category">
  <option value="">カテゴリー一覧</option>
  <?php
      $terms = get_terms('voice_category');
      foreach ($terms as $term) { ?>
  <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
  <?php } ?>
</select>
<?php
    }
  }
  add_action( 'restrict_manage_posts', 'add_voice_taxonomy_restrict_filter' );


  /* キャンペーン一覧にカテゴリー欄を追加 */
  function add_campaign_posts_column( $defaults ) {
    $defaults['campaign_category'] = 'カテゴリー'; //'campaign_cat'はタクソノミー名
    return $defaults;
  }
  add_filter('manage_campaign_posts_columns', 'add_campaign_posts_column');

  function add_campaign_posts_column_id($column_name, $id) {
    $terms = get_the_terms($id, $column_name);
    if ( $terms && ! is_wp_error( $terms ) ){
      $campaign_cat_links = array();
      foreach ( $terms as $term ) {
        $campaign_cat_links[] = $term->name;
      }
      echo join( ", ", $campaign_cat_links ); //join：配列要素を文字列で結合(", "は区切り方)
    }
  }
  add_action('manage_campaign_posts_custom_column', 'add_campaign_posts_column_id', 10, 2);

  /* お客様の声一覧にカテゴリー欄を追加 */
  function add_voice_posts_column( $defaults ) {
    $defaults['voice_category'] = 'カテゴリー'; //'voice_cat'はタクソノミー名
    return $defaults;
  }
  add_filter('manage_voice_posts_columns', 'add_voice_posts_column');

  function add_voice_posts_column_id($column_name, $id) {
    $terms = get_the_terms($id, $column_name);
    if ( $terms && ! is_wp_error( $terms ) ){
      $voice_cat_links = array();
      foreach ( $terms as $term ) {
        $voice_cat_links[] = $term->name;
      }
      echo join( ", ", $voice_cat_links );
    }
  }
  add_action('manage_voice_posts_custom_column', 'add_voice_posts_column_id', 10, 2);

  /* キャンペーン一覧カラムの順序を変更 */
  function campaign_sort_column($columns){
    $columns = array(
      'title' => '記事タイトル',
      'taxonomy-campaign_category' => 'カテゴリー',
      'date' => '投稿日時',
      'thumbnail' => 'アイキャッチ'
    );
    return $columns;
  }
  add_filter( 'manage_campaign_posts_columns', 'campaign_sort_column');

  /* お客様の声一覧カラムの順序を変更 */
  function voice_sort_column($columns){
    $columns = array(
      'title' => '記事タイトル',
      'taxonomy-voice_category' => 'カテゴリー',
      'date' => '投稿日時',
      'thumbnail' => 'アイキャッチ'
    );
    return $columns;
  }
  add_filter( 'manage_voice_posts_columns', 'voice_sort_column');


  /*=================================================================
      アーカイブの表示件数変更
  ==================================================================*/
  function change_per_page($query) {
    if ( is_admin() || ! $query->is_main_query() ) {
      return;
    }
    if ( $query->is_post_type_archive('campaign') ) {
      $query->set( 'posts_per_page', '4' ); // 表示件数
      return;
    }
    if ( $query->is_post_type_archive('voice') ) {
      $query->set( 'posts_per_page', '6' ); // 表示件数
      return;
    }
    //カスタムタクソノミーのタームのアーカイブ表示件数変更
    if ( $query->is_tax('campaign_category') ) {
      $query->set( 'posts_per_page', '4' ); // 表示件数
      return;
    }
    if ( $query->is_tax('voice_category') ) {
      $query->set( 'posts_per_page', '6' ); // 表示件数
      return;
    }
  }
  add_action( 'pre_get_posts', 'change_per_page' );

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

  /*管理画面のカラムを追加*/
  function manage_posts_columns($columns) {
    $columns['post_views_count'] = 'view数';
    $columns['thumbnail'] = 'アイキャッチ';

    return $columns;
  }
  add_filter('manage_posts_columns', 'manage_posts_columns');

  /*アクセス数を出力*/
  function add_column($column_name, $post_id) {
    /*View数呼び出し*/
    if ($column_name === 'post_views_count') {
      $pv = get_post_meta($post_id, 'post_views_count', true);
    }

    /*アイキャッチ呼び出し*/
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