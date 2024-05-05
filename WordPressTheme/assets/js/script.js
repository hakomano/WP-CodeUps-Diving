"use strict";

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  //========================================================*
  // ローディングアニメーション
  //========================================================*
  // $(function () {
  //   $(window).on('load', function () {
  //     //ページを開いて1秒後にテキストを0.6秒かけて非表示
  //     $('.js-loader-title').delay(1000).fadeOut(600);

  //     //2つに分かれた画像がスライドアップ(右の画像が80px遅れ)最終的に1枚の画像になる
  //     $('.js-loader-left').delay(1200).addClass("slideUp");
  //     $('.js-loader-right').delay(1300).addClass("slideUp");

  //     //画像が出て数秒後にタイトルが浮き出る(カラーが白に変わる)
  //     $('.js-loader-title').hide();
  //     $('.js-loader-title').delay(2000).css("color","white").fadeIn(600);

  //     //ページを開いて5秒後にローダー画面をゆっくり非表示
  //     $('.js-loader').delay(5000).fadeOut('slow');
  //   });

  //   //ページ読み込みが終わってなくても5秒後にはローディング画面を非表示(ユーザー離脱防止)
  //   setTimeout(function(){
  //     $('.js-loader').fadeOut('slow');
  //   },5000);
  // });

  //ローディング画面を初回一回目のみ表示(同ブラウザ上で)の場合はこちら

  $(function () {
    if (sessionStorage.getItem('visit')) {
      $(".js-loader").css("display", "none");
    } else {
      sessionStorage.setItem('visit', 'true');
      $(window).on('load', function () {
        //ページを開いて1秒後にテキストを0.6秒かけて非表示
        $('.js-loader-title').delay(1000).fadeOut(600);

        //2つに分かれた画像がスライドアップ(右の画像が80px遅れ)最終的に1枚の画像になる
        $('.js-loader-left').delay(1200).addClass("slideUp");
        $('.js-loader-right').delay(1300).addClass("slideUp");

        //画像が出て数秒後にタイトルが浮き出る(カラーが白に変わる)
        $('.js-loader-title').hide();
        $('.js-loader-title').delay(2000).css("color", "white").fadeIn(600);

        //ページを開いて5秒後にローダー画面をゆっくり非表示
        $('.js-loader').delay(5000).fadeOut('slow');
      });

      //ページ読み込みが終わってなくても5秒後にはローディング画面を非表示(ユーザー離脱防止)
      setTimeout(function () {
        $('.js-loader').fadeOut('slow');
      }, 5000);
    }
  });

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
    $("body").css({
      height: "100%",
      overflow: "hidden"
    }); //背景はスクロールさせない
  }

  function closeDrawer() {
    $(".js-drawer").fadeOut();
    $(".js-hamburger").removeClass("is-open");
    $("body").css({
      height: "",
      overflow: ""
    });
  }

  //========================================================*
  // フッター表示されたら追従ヘッダーを非表示 ⇒CSSのFBにてNG
  //========================================================*
  // $(".footer").on('inview', function(event, isInViewHeader){
  //   if (isInViewHeader) {
  //     $(".js-header").fadeOut();
  //   } else {
  //     $(".js-header").fadeIn();
  //   }
  // });

  //========================================================*
  // ページトップボタン処理(フッター手前で止まる)
  //========================================================*
  $(function () {
    var pageTop = $(".js-page-top");

    //トップへ戻るボタンのスクロールイベント
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

    //500pxスクロールしたらボタンを表示・非表示
    function btnScrollEvent() {
      if ($(window).scrollTop() > 500) {
        pageTop.fadeIn(); // 500px以上スクロールしたら表示
      } else {
        pageTop.fadeOut(); //スクロールが500px以下の場合、非表示
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
  // ファーストビュースライダー(swiper)
  //========================================================*
  var fvSwiper = new Swiper(".js-fv-swiper", {
    loop: true,
    //無限ループさせる
    speed: 2000,
    //スライド切替アニメーションのスピードを指定(ミリ秒)
    effect: "fade",
    //フェード切替
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 3000,
      //次のスライドに切り替わるまでの時間を指定（ミリ秒）
      disableOnInteraction: false //ユーザーが操作時に自動再生止めない
    },

    allowTouchMove: false //ドラッグ（スワイプ）でのスライド切替を無効
  });

  //========================================================*
  // キャンペーンスライダー(swiper)
  //========================================================*
  // リサイズ処理（PC時のみ矢印表示）
  var campaignSlideLength = document.querySelectorAll('.js-campaign-swiper .swiper-slide').length;
  $(window).resize(function () {
    campaign_arrow();
  });
  campaign_arrow();
  function campaign_arrow() {
    if (window.matchMedia('(max-width: 767px)').matches || campaignSlideLength <= 3) {
      $('.js-campaign-arrow').hide();
    } else {
      $('.js-campaign-arrow').show();
    }
  }

  // Swiper(キャンペーンスライダー)
  var campaignSwiper = new Swiper(".js-campaign-swiper", {
    loop: true,
    //無限ループさせる
    speed: 2000,
    //スライド切替アニメーションのスピードを指定(ミリ秒)
    slidesPerView: '1.26',
    //表示させるスライド数(CSSでサイズ指定する場合は'auto')
    spaceBetween: 24,
    //スライド間の余白を指定(px)
    autoplay: {
      delay: 2000,
      //次のスライドに切り替わるまでの時間を指定（ミリ秒）
      disableOnInteraction: false //ユーザーが操作時に自動再生止めない
    },

    breakpoints: {
      768: {
        //タブレット時(カードが小さくなりすぎないように)
        slidesPerView: "2.5",
        spaceBetween: 30
      },
      1230: {
        slidesPerView: "3.49",
        spaceBetween: 40
      }
    },
    navigation: {
      nextEl: ".top-campaign__btn-next",
      prevEl: ".top-campaign__btn-prev"
    }
  });

  //========================================================*
  // 背景色の後に画像やテキストが表示されるエフェクトアニメーション
  //========================================================*
  //要素の取得とスピードの設定
  var box = $('.colorbox'),
    speed = 700;

  //.colorboxの付いた全ての要素に対して下記の処理を行う
  box.each(function () {
    $(this).append('<div class="color"></div>');
    var color = $(this).find($('.color')),
      image = $(this).find('img');
    var counter = 0;
    image.css('opacity', '0');
    color.css('width', '0%');
    //inviewを使って背景色が画面に現れたら処理をする
    color.on('inview', function () {
      if (counter == 0) {
        $(this).delay(200).animate({
          'width': '100%'
        }, speed, function () {
          image.css('opacity', '1');
          $(this).css({
            'left': '0',
            'right': 'auto'
          });
          $(this).animate({
            'width': '0%'
          }, speed);
        });
        counter = 1;
      }
    });
  });
});