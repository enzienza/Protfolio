/**
 * Name file: BTN-MENU
 * Description: This script include :
 *              - animation button burger
 *              - toggle menu full screen for mobile (open/close)
 *              - smooth scrolling after click menu item
 *
 * Version: 1.0
 * Author: Enza Lombardo
 */

jQuery(document).ready(function ($) {

  // ToggleClass 'toggle' & open menu
  $(document).ready(function () {
    $('#btn-menu').click(function () {
      $(this).toggleClass('open');
      $('header').toggleClass('toggle');
    })
  });

  // close menu after click
  $(window).on('scroll load',function(){
    $('#btn-menu').removeClass('open');
    $('header').removeClass('toggle');
  });

  // smooth scrolling
  $('.navbar-nav li a[href*="#"]').on('click',function(e){
    e.preventDefault();
    $('html, body').animate({
        scrollTop : $($(this).attr('href')).offset().top,
      }, 500, 'linear'
    );
  });

});