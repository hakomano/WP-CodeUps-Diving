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
  // アコーディオンメニュー(FAQページ)
  //========================================================*
  $('.js-faq-question').on('click', function () {
    $(this).next().slideToggle();
    $(this).toggleClass('active');
  });

  //========================================================*
  // アコーディオンメニュー(サイドバーのアーカイブ)
  //========================================================*
  //1番上のメニューは開いておく
  $(".sidebar-archive__year:first-of-type .sidebar-archive__list-months").css("display", "block");
  $(".sidebar-archive__year:first-of-type > .js-archive-toggle").addClass("active");
  $('.js-archive-toggle').on('click', function () {
    $(this).next().slideToggle();
    $(this).toggleClass('active');
  });

  //========================================================*
  // モーダルウィンドウ
  //========================================================*
  // 『モーダルを開くボタン』をクリックしたら、『モーダル本体』を表示
  $(".js-modal-open").click(function () {
    $(".js-modal").fadeIn(400);

    // クリックした画像のHTML要素を取得して、置き換える
    $(".modal__content").html($(this).prop('innerHTML'));

    // サイトのスクロールを禁止にする
    $('html, body').css('overflow', 'hidden');
  });

  // 『背景』をクリックしたら、『モーダル本体』を非表示
  $(".js-modal").click(function () {
    $(this).fadeOut(400);

    // サイトのスクロール禁止を解除する
    $('html, body').removeAttr('style');
  });

  //========================================================*
  // タブメニュー
  //========================================================*
  //タブ指定リンク(指定タブを開いた状態で表示)
  $(function () {
    if (location.href.match('#tab')) {
      $(".js-tab").removeClass("current");
      var hash = $(location).attr('hash');
      $(".js-tab-content" + hash).css('display', 'block');
      $(".js-tab" + hash + "-menu").addClass("current");
    } else {
      $(".js-tab-content:first-of-type").css("display", "block");
    }
  });

  //タブメニューをクリックで該当するコンテンツ表示
  $(".js-tab").on("click", function () {
    $(".js-tab.current").removeClass("current");
    $(this).addClass("current");
    var index = $(this).index();
    $(".js-tab-content").hide().eq(index).fadeIn(400);
  });
});