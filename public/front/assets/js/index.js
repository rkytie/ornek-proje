$(document).ready(function () {
  $(".ui.accordion").accordion();
  $(".ui.dropdown").dropdown();
  
  //NAVBAR BOX-SHADOW CLASS ADD
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if ($(window).scrollTop() > 100) {
      $('header').addClass('navbar-fixed');
    } else {
      $('header').removeClass('navbar-fixed');
    }
  }

  //HAMBURGER MENU
  $('a.target-burger').click(function (e) {
    $('div.container, nav.main-nav, a.target-burger').toggleClass('toggled');
    e.preventDefault();
  }); //target-burger-click

  // Mobile Accordion Menu
  $('.mobile-nav-dropdown').click(function (event) {
    if ($('.mobile-nav-dropdown .content').hasClass('active')) {
      $('.mobile-nav-dropdown .content').removeClass('active');
      $('.mobile-nav-dropdown .angle.icon').removeClass('up');
      $('.mobile-nav-dropdown .angle.icon').addClass('down');
    } else {
      $(this).children('.content').addClass('active');
      $(this).children('.title').children('.angle.icon').removeClass('down');
      $(this).children('.title').children('.angle.icon').addClass('up');
    }
  });
  

  var c = 2;
  var timer = 0;
  setInterval(function () {
    $(".progress-bar .active").css("width", timer + "%");
    timer++;

    if (timer == 100) {
      timer = 1;
      $(".hero .item").removeClass("active");
      $(".hero .item-" + c).addClass("active");
      $(".progress-text span").html(c);
      c++;
      if (c == 4) {
        c = 1;
      }
    }
  }, 35);

});
