<?php
/**
 * Name file: custom-dashboard
 * Description: this file allows you to hide differents menu items in the dashboard
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */



/**
 * Table of Contents:
 *
 * 1 - Hides menus
 * 2 - Editor toolbar
 * 3 - Reusable blocks
 *
 */

/*
 * 1 - Hides menus
 *     Function for hides certain page (components of menu) of dashboard
 */

if(!function_exists('remove_menus')) {
    function remove_menus()
    {
        // remove_menu_page('section.php');                 // Tableau de bord
        // remove_menu_page('edit.php');                    // Articles
        // remove_menu_page('upload.php');                  // Media
        // remove_menu_page('edit.php?post_type=page');     // Pages
        remove_menu_page('edit-comments.php');    // Commentaires
        // remove_menu_page('themes.php');                  // Apparences
        // remove_menu_page('plugins.php');                 // Extentions
        // remove_menu_page('users.php');                   // Utilisateurs
        // remove_menu_page('tools.php');                   // Outils
        // remove_menu_page('options-general.php');         // Réglages

        // remove_menu_page('edit.php?post_type=recettes'); // pour masque un custom_post_type
    }
}
add_action('admin_menu', 'remove_menus');


/**
 * 2 - Editor toolbar
 *     Function for customize the editor toolbar of WordPress
 */
if(!function_exists('custom_tinymce')) {
    function custom_tinymce($tools)
    {
        $tools['toolbar1'] = 'formatselect,bold,italic,bullist,numlist,blockquote,hr,alignjustify,link,unlink,removeformat,charmap,outdent,indent,undo,redo,wp_fullcreen';

        $tools['block_formats'] = 'Paragraph=p;Heading 1=h2;Heading 2=h3;Heading 3=h4;Heading 4=h5;Heading 5=h6;Heading 6=h6;';
        return $tools;
    }
}
add_filter('tiny_mce_before_init', 'custom_tinymce');

/**
 * 3 - Reusable blocks
 *     Function for adding on menu, the management page of reusable blocks of the gutenberg editor
 */
//if (!function_exists('reusable_blocks')){
//    function reusable_blocks(){
//        add_menu_page(
//            __('Blocs réutilisables', 'mycv'),  // page_title
//            __('Blocs réutilisables', 'mycv'),  // menu_title
//            'manage_options',               // permition
//            'edit.php?post_type=wp_block', // menu_slug
//            '',                              // callback
//            'dashicons-editor-table',        // icon
//            22                               // position
//        );
//    }
//}
//add_action('admin_menu', 'reusable_blocks');