"use strict";

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  //========================================================*
  // ハンバーガーメニュー(フェードイン・アウト)
  //========================================================*
  $(function () {
    $(".js-hamburger").on("click", function () {
      $(this).toggleClass("is-open");
      if ($(this).hasClass("is-open")) {
        openDrawer();
      } else {
        closeDrawer();
      }
    });

    // backgroundまたはページ内リンクをクリックで閉じる
    $(".js-drawer a[href]").on("click", function () {
      closeDrawer();
    });

    // resizeイベント
    $(window).on('resize', function () {
      if (window.matchMedia("(min-width: 768px)").matches) {
        closeDrawer();
      }
    });
  });
  function openDrawer() {
    $(".js-drawer").fadeIn();
    $(".js-hamburger").addClass("is-open");
  }
  function closeDrawer() {
    $(".js-drawer").fadeOut();
    $(".js-hamburger").removeClass("is-open");
  }

  //========================================================*
  // ページトップボタン処理(フッター手前で止まる)
  //========================================================*
  $(function () {
    var pageTop = $(".js-page-top");

    //トップへ戻るボタンのクリックイベント
    // pageTop.on("click", scrollTop);
    $(window).on("scroll", function () {
      btnScrollEvent();
      btnPosition();
    });

    //ページトップへスムーススクロールする
    pageTop.click(function () {
      $("body,html").animate({
        scrollTop: 0
      }, 500 //スクロールの速さを変える場合はここ
      );

      return false;
    });

    //400pxスクロールしたらボタンを表示・非表示
    function btnScrollEvent() {
      if ($(window).scrollTop() > 400) {
        pageTop.fadeIn(); // 400px以上スクロールしたら表示
      } else {
        pageTop.fadeOut(); //スクロールが400px以下の場合、非表示
      }
    }

    //フッター手前での処理(ボタンはフッターより上で止まる)
    function btnPosition() {
      var scrollHeight = $(document).height();
      var scrollPosition = $(window).height() + $(window).scrollTop();
      var footHeight = $("footer").outerHeight();
      if (scrollHeight - scrollPosition <= footHeight && window.matchMedia("(max-width: 768px)").matches) {
        pageTop.css({
          position: "absolute",
          bottom: footHeight + 16 + "px" //フッター手前のsp時
        });
      } else if (scrollHeight - scrollPosition <= footHeight && window.matchMedia("(min-width: 767px)").matches) {
        pageTop.css({
          position: "absolute",
          bottom: footHeight + 20 + "px" //フッター手前のpc時
        });
      } else if (window.matchMedia("(max-width: 768px)").matches) {
        pageTop.css({
          position: "fixed",
          bottom: 16 + "px" //sp時
        });
      } else if (window.matchMedia("(min-width: 767px)").matches) {
        pageTop.css({
          position: "fixed",
          bottom: 20 + "px" //pc時
        });
      }
    }
  });

  //========================================================*
  // 画面サイズが変わったときに高さを更新する(100vh対応)
  //========================================================*
  window.addEventListener('resize', function () {
    var vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
  });

  //========================================================*
  // お問い合わせフォームの必須項目チェック
  //========================================================*
  $('.js-submit').click(function (event) {
    // エラーメッセージ要素を取得
    var errorMessage = $('.js-contact-error');
    var errorMessageCheck = $('.js-check-error');
    var errorMessageAgree = $('.js-agree-error');

    //エラーメッセージリセット
    errorMessage.hide();
    errorMessageCheck.hide();
    errorMessageAgree.hide();

    // 入力フィールドに変更があった場合、エラークラスを削除
    $('input, textarea').on('input', function () {
      if ($(this).hasClass('error')) {
        $(this).removeClass('error'); // エラークラスを削除
        $('input[name="entry[]"]').removeClass('error'); //チェックボックス１つ選択で全てのエラークラス削除
      }
    });

    // 必須入力項目の検証
    var name = $('input[type="text"]').val().trim();
    var email = $('input[type="email"]').val().trim();
    var tel = $('input[type="tel"]').val().trim();
    var message = $('textarea[id="message"]').val().trim();
    var formValid = true;
    var formChecked = true;
    var formAgree = true;

    // 未入力の必須項目があるかチェックし、対象の入力欄にクラス追加
    if (!name) {
      $('input[type="text"]').addClass('error');
      formValid = false;
    }
    if (!email) {
      $('input[type="email"]').addClass('error');
      formValid = false;
    }
    if (!tel) {
      $('input[type="tel"]').addClass('error');
      formValid = false;
    }
    if (!message) {
      $('textarea[id="message"]').addClass('error');
      formValid = false;
    }

    // お問い合わせ項目のチェックボックス検証(1つ以上のチェック)
    var entryChecked = $('input[name="entry[]"]:checked').length > 0;
    if (!entryChecked) {
      $('input[name="entry[]"]').addClass('error');
      formChecked = false;
    }

    // プライバシーポリシー同意のチェックボックス検証
    var privacyChecked = $('input[id="agree"]:checked').length > 0;
    if (!privacyChecked) {
      formAgree = false;
    }

    // 未入力箇所に応じてエラーメッセージを表示し、送信を中止
    // チェックボックス選択がない(他の入力欄は入力あり)場合
    if (!formChecked && formValid || !formChecked && formValid && !formAgree) {
      event.preventDefault(); // フォームの送信を中止
      errorMessageCheck.show();
      $('.js-form').css('margin-top', '2.5rem');
      $("body,html").animate({
        scrollTop: 400
      }, 1);
      // 同意チェックのみがない場合
    } else if (!formAgree && formValid && formChecked) {
      event.preventDefault();
      errorMessageAgree.show();
      $('.js-form').css('margin-top', '2.5rem');
      $('input[id="agree"]').addClass('error');
      $("body,html").animate({
        scrollTop: 400
      }, 1);
      // 入力欄の未入力がある場合
    } else if (!formValid) {
      event.preventDefault();
      errorMessage.show();
      $('.js-form').css('margin-top', '2.5rem');
      $("body,html").animate({
        scrollTop: 400
      }, 1);
    } else {
      errorMessageCheck.hide();
      errorMessageAgree.hide();
      errorMessage.hide();

      // event.preventDefault(); // 送信できるようにする時は消す
    }
  });
});