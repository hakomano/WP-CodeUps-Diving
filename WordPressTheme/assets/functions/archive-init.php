<?php
  /*=================================================================
      アーカイブの表示件数変更
  ==================================================================*/
  function change_per_page($query) {
    if ( is_admin() || !$query->is_main_query() ) {
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
      月別アーカイブのタイトル出力(the_archive_title)時の整形
  ==================================================================*/
  /* フィルターを使用して余計な文字を削除し、特定の形式に整える */
  add_filter( 'get_the_archive_title', function ($title) {
    if (is_year()) {
        // 年別アーカイブの場合、年を取得
        $title = get_the_time('Y年');
    } elseif (is_month()) {
        // 月別アーカイブの場合、年と月を取得
        $title = get_the_time('Y年n月');
    }
    return $title;
  });

  /*=================================================================
      ループ回数を取得(続きを見るボタンのclass名用)
  ==================================================================*/
  function loopNumber(){
    global $wp_query;
    return $wp_query->current_post+1;
  }