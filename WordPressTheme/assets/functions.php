<?php
  /*=================================================================
      分割したファイルを読み込む(functionsフォルダ内)
  ==================================================================*/
  // 分割したファイルパスを配列に追加
  $function_files = [
    '/functions/init.php',
    '/functions/archive-init.php',
    '/functions/sidebar-init.php',
    '/functions/contact-form.php',
    '/functions/wp-admin.php'
  ];

  foreach ($function_files as $file) {
    if ((file_exists(__DIR__ . $file))) { // ファイルが存在する場合
      // ファイルを読み込む
      locate_template($file, true, true);
    } else { // ファイルが見つからない場合
      // エラーメッセージを表示
      trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
    }
  }