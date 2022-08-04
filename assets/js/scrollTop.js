/**
 * Name file: Scroll Top
 * Description: to make jQuery scroll to different places of the document, you can use .scrollTo()
 *
 * Version: 1.0
 * Author: Enza Lombardo
 */

jQuery(document).ready(function ($) {

  $(window).scroll(function() {
    if($(window).scrollTop() > 50){
      $('.scrollTop').show()
    } else{
      $('.scrollTop').hide()
    }
  });

});