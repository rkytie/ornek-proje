$(document).ready(function () {
  //NAVBAR BOX-SHADOW CLASS ADD
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if ($(window).scrollTop() > 100) {
      $('header').addClass('scroll-on');
    } else {
      $('header').removeClass('scroll-on');
    }
  }

  //HAMBURGER MENU
  $('a.target-burger').click(function (e) {
    $('div.container, nav.main-nav, a.target-burger').toggleClass('toggled');
    e.preventDefault();
  }); //target-burger-click

  if ($('.main-product-detail .slider-area').length) {
    $('.slider-area .slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav',
    });
    $('.slider-area .slider-nav').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      focusOnSelect: true,
      centerPadding: '10px',
      prevArrow: '<i class="chevron-left"></i>',
      nextArrow: '<i class="chevron-right"></i>',
      responsive: [
        {
          breakpoint: 670,
          settings: {
            slidesToShow: 2,
          },
        },
      ],
    });
  }

  if ($('.comments-slider').length) {
    $('.comments-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      prevArrow: '<i class="chevron-left"></i>',
      nextArrow: '<i class="chevron-right"></i>',
      dots: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 670,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  if ($('.hero-slider').length) {
    $('.hero-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  }

  if ($('.brands').length) {
    $('.brands .container').slick({
      slidesToShow: 10,
      slidesToScroll: 3,
      prevArrow: '<i class="chevron-left"></i>',
      nextArrow: '<i class="chevron-right"></i>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 3,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  if ($('.categories').length) {
    $('.categories .container').slick({
      slidesToShow: 7,
      slidesToScroll: 3,
      prevArrow: '<i class="chevron-left"></i>',
      nextArrow: '<i class="chevron-right"></i>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 3,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  if (typeof lightbox !== 'undefined') {
    lightbox.option({
      resizeDuration: 100,
      wrapAround: true,
    });
  }
});
