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

  // Add Class WordPress CURRENT-MENU-ANCESTOR
  $(document).ready(function () {
    let menu_ascend = $(".sidebar-content li a");

    menu_ascend.each(function () {
      if ($(this).is('[href*="#"')) {
        let menu_active = $(".current-menu-item .current_page_item .current-menu-ancestor");
        $(this).parent().removeClass(menu_active);

        $(this).click(function () {
          let current_index  = $(this).parent().index();
          let parent_element = $(this).closest('ul');
          let menu_active = $(".current-menu-item .current_page_item .current-menu-ancestor");

          parent_element.find('li').not(':eq(' + current_index + ')').removeClass(menu_active);
          $(this).parent().addClass(menu_active);
        })
      }
    })
  })
});