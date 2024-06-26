<?php
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

  /* 管理画面から一部サブメニューを非表示にする */
  function remove_sub_menus() {
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // 通常投稿カテゴリー
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // 通常投稿タグ
  }
  add_action( 'admin_menu', 'remove_sub_menus', 999 );

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
      【管理画面】通常投稿一覧画面カスタマイズ
  ==================================================================*/
  /* 投稿一覧に最終更新日の列を表示(並び替えも可) */
  // 最終更新日の列を作成
  function aco_last_modified_admin_column( $columns ) {
    $columns['modified-last'] =__( '最終更新日', 'aco' );
    return $columns;
  }
  add_filter( 'manage_edit-post_columns', 'aco_last_modified_admin_column' );

  // 最終更新した時間で記事を並べ替える
  function aco_sortable_last_modified_column( $columns ) {
    $columns['modified-last'] = 'modified';
    return $columns;
  }
  add_filter( 'manage_edit-post_sortable_columns', 'aco_sortable_last_modified_column' );

  // 出力をフォーマット
  function aco_last_modified_admin_column_content( $column_name, $post_id ) {
    if ( 'modified-last' != $column_name )
      return;

    $modified_date   = the_modified_date( 'Y年Md日' );

    echo $modified_date;
  }
  add_action( 'manage_posts_custom_column', 'aco_last_modified_admin_column_content', 10, 2 );


  /* ブログ一覧カラムの順序を変更 */
  function blog_sort_column($columns){
    $columns = array(
      'cb' => '<input id="cb-select-all-1" type="checkbox">',
      'title' => '記事タイトル',
      'date' => '投稿日時',
      'modified-last' => '最終更新日',
      'author' => '投稿者',
      'thumbnail' => 'アイキャッチ',
      'post_views_count' => '閲覧数'
    );
    return $columns;
  }
  add_filter( 'manage_posts_columns', 'blog_sort_column');

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

  /* キャンペーン一覧に開催期間欄を追加 */
  function add_posts_columns($columns){
    $columns['campaign_period'] = '開催期間';
    return $columns;
  }
  add_filter('manage_campaign_posts_columns', 'add_posts_columns');

  // カスタムフィールドのカラムを追加する
  function campaign_custom_posts_column( $column_name, $post_id ) {
    if ( $column_name == 'campaign_period' ) {
      // グループフィールドを取得
      $campaignPeriod = get_field('campaign_period', $post_id);
      // グループフィールド内の「開始日」フィールドを取得
      $startDate = $campaignPeriod['start_date'];
      // グループフィールド内の「終了日」フィールドを取得
      $endDate = $campaignPeriod['end_date'];
      //開始日と終了日から年を取得
      $startYear = date('Y', strtotime($startDate));
      $endYear = date('Y', strtotime($endDate));

      if ( $startDate ){
        echo esc_html( date('Y.n/j', strtotime($startDate)) .' - ' );
      }
      if ( $endDate ){
        if ( $startYear === $endYear ) {
          echo esc_html( date('n/j', strtotime($endDate)) );
        } else {
          echo  esc_html( date('Y.n/j', strtotime($endDate)) );
        }
      }
    }
  }
  add_filter('manage_campaign_posts_custom_column', 'campaign_custom_posts_column', 10, 2);

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
      'cb' => '<input id="cb-select-all-1" type="checkbox">',
      'title' => '記事タイトル',
      'taxonomy-campaign_category' => 'カテゴリー',
      'campaign_period' => '開催期間',
      'date' => '投稿日時',
      'thumbnail' => 'アイキャッチ',
    );
    return $columns;
  }
  add_filter( 'manage_campaign_posts_columns', 'campaign_sort_column');

  /* お客様の声一覧カラムの順序を変更 */
  function voice_sort_column($columns){
    $columns = array(
      'cb' => '<input id="cb-select-all-1" type="checkbox">',
      'title' => '記事タイトル',
      'taxonomy-voice_category' => 'カテゴリー',
      'date' => '投稿日時',
      'thumbnail' => 'アイキャッチ'
    );
    return $columns;
  }
  add_filter( 'manage_voice_posts_columns', 'voice_sort_column');

  /*=================================================================
      【管理画面】固定ページのカスタマイズ
  ==================================================================*/
  // 固定ページの不要な項目を非表示にする
  function my_remove_post_editor_support() {
    remove_post_type_support( 'page', 'thumbnail' ); // アイキャッチ非表示
  }
  add_action( 'init' , 'my_remove_post_editor_support' );
  
  /*=================================================================
      【管理画面】ダッシュボードカスタマイズ
  ==================================================================*/
  /* ダッシュボードにスタイルシートを読み込む */
  function custom_admin_enqueue(){
    wp_enqueue_style('custom_admin_enqueue', get_theme_file_uri('/css/dashboard_styles.css'));
  }
  add_action( 'admin_enqueue_scripts', 'custom_admin_enqueue' );

  /* 新しいウィジェットを追加する① */
  function add_dashboard_widgets1() {
    wp_add_dashboard_widget(
      'quick_action_dashboard_widget', // ウィジェットのスラッグ名
      'ショートカットリンク', // ウィジェットに表示するタイトル
      'dashboard_widget_function1' // 実行する関数
    );
  }
  add_action( 'wp_dashboard_setup', 'add_dashboard_widgets1' );

  /* ウィジェットに表示するHTMLを定義する */
  function dashboard_widget_function1() {
    echo '<ul class="custom_widget">
            <a href="post-new.php"><li><p>新しく記事を書く</p><div class="dashicons dashicons-edit"></div><p class="post-name"><span>●-- ブログ --●</span></p></li></a>
            <a href="post-new.php?post_type=campaign"><li><p>新しく記事を書く</p><div class="dashicons dashicons-megaphone"></div><p class="post-name"><span>●-- キャンペーン --●</span></p></li></a>
            <a href="post-new.php?post_type=voice"><li><p>新しく記事を書く</p><div class="dashicons dashicons-format-status"></div><p class="post-name"><span>●-- お客様の声 --●</span></p></li></a>
            <a href="post.php?post=35&action=edit"><li><p>料金の変更</p><div class="dashicons dashicons-calculator"></div><p class="post-name"><span>●-- コース料金表 --●</span></li></a>
            <a href="post.php?post=38&action=edit"><li><p>FAQ 追加</p><div class="dashicons dashicons-editor-help"></div><p class="post-name"><span>●-- よくある質問 --●</span></li></a>
            <a href="post.php?post=29&action=edit"><li><p>ギャラリー画像追加</p><div class="dashicons dashicons-camera-alt"></div><p class="post-name"><span>●-- ギャラリーフォト --●</span></li></a>
          </ul>';
  }

  /* 新しいウィジェットを追加する② */
  function add_dashboard_widgets2() {
    wp_add_dashboard_widget(
      'request_dashboard_widget', // ウィジェットのスラッグ名
      '基本設定の変更はこちらから', // ウィジェットに表示するタイトル
      'dashboard_widget_function2' // 実行する関数
    );
  }
  add_action( 'wp_dashboard_setup', 'add_dashboard_widgets2' );

  /* ウィジェットに表示するHTMLを定義する */
  function dashboard_widget_function2(){
    echo '<div class="setting_widget">
    <p>基本設定で変更等がある場合は下記のリンクから設定ページへ移動できます</p>
    <ul>
      <li><a href="post.php?post=8&action=edit"><div class="dashicons dashicons-admin-generic"></div>【 SNSリンク 】設定へ</a></li>
      <li><a href="post.php?post=8&action=edit"><div class="dashicons dashicons-admin-generic"></div>【 店情報 (住所・TEL・営業時間・定休日) 】設定へ</a></li>
      <li><a href="post.php?post=8&action=edit"><div class="dashicons dashicons-admin-generic"></div>【 トップページのメインスライダー画像 】設定へ</a></li>
      <li><a href="post.php?post=49&action=edit"><div class="dashicons dashicons-admin-generic"></div>【 プライバシーポリシー 】設定へ</a></li>
      <li><a href="post.php?post=51&action=edit"><div class="dashicons dashicons-admin-generic"></div>【 利用規約 】設定へ</a></li>
    </ul>
          </div>';
  }

  /*=================================================================
      【管理画面】ログイン画面カスタマイズ
  ==================================================================*/
  /* ログイン画面のロゴ変更 */
  function custom_login_logo() {
    echo '<style type="text/css">
      body{
        background-color: #DDF0F1;
      }
      .login #login-message, .login #loginform{
        border: 3px solid #408F95;
        border-radius: 10px;
      }
      .login input[type=text], .login input[type=password]{
        background-color: #A2C2C4;
        border: none;
        border-radius: 5px;
      }
      .login input[type=text]:focus, .login input[type=password]:focus{
        outline: 2px solid #408F95;
      }
      .login h1 a {
        display: block;
        background-repeat: no-repeat;
        background-size: contain;
        background-image: url('.get_theme_file_uri( '/images/common/logo-green.svg' ).');
        width: 300px;
      }
      .wp-core-ui .button-primary{
        background-color: #A2C2C4;
        border: none;
        border-radius: 10px;
        margin-top: 30px;
      }
      .login input[type=checkbox]{
        border: 2px solid #408F95;
        border-radius: 5px;
      }
      .login p.submit{
        margin-top: 20px;
      }
    </style>'.PHP_EOL;
  }
  add_action( 'login_head', 'custom_login_logo' );


  /* ログイン画面のロゴURL */
  function custom_login_logo_url() {
    return esc_url( home_url( '/' ) );
  }
  add_filter( 'login_headerurl', 'custom_login_logo_url' );