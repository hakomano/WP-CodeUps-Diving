<?php
  /*=================================================================
      Contact Form 7 設定
  ==================================================================*/
  /* CF7で自動挿入されるPタグ、brタグを削除 */
  add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
  function wpcf7_autop_return_false() {
    return false;
  }

  /* 自動生成されるformタグにclass名を追加 */
  function my_wpcf7_form_class_attr($class) {
    $my_class = "sub-contact__form contact-form js-form " . $class;
    return $my_class;
  }
  add_filter('wpcf7_form_class_attr','my_wpcf7_form_class_attr', 10, 2);

  /* ドロップダウンメニューの選択肢をキャンペーン記事のタイトルから自動生成 */
  function campaign_selectlist ( $tag, $unused ) {
    if ( $tag['name'] != 'select_campaign' )  // CF7フィールド名（独自のフォームタグ名）
      return $tag;
    $args = array (
      'posts_per_page' => -1, // 全件取得（制限が必要な場合は数値を指定）
      'post_type' => 'campaign', // カスタム投稿スラッグ
      'post_status' => 'publish', // 公開のみ
      // 'orderby' => 'ID', // 並び順(指定しなければ投稿日順)
      'order' => 'ASC', // 昇順
    );
    $custom_posts = get_posts($args);
    if ( ! $custom_posts )
      return $tag;
    foreach ( $custom_posts as $custom_post ) {
      $tag['raw_values'][] = $custom_post->post_title;
      $tag['values'][] = $custom_post->post_title;
      $tag['labels'][] = $custom_post->post_title;
    }
    return $tag;
  }
  add_filter( 'wpcf7_form_tag', 'campaign_selectlist', 30, 2);

  /* CF7の送信ボタンをクリックした後の遷移先設定 */
  add_action( 'wp_footer', 'add_origin_thanks_page' );
  function add_origin_thanks_page() {
  $thanks = home_url('/contact-thanks');
    echo <<< EOC
      <script>
        var thanksPage = {
          163 : '{$thanks}',
        };
      document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = thanksPage[event.detail.contactFormId];
      }, false );
      </script>
    EOC;
  }