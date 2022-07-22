<?php
/**
 * Name file: config-theme
 * Description: this file allows you to ass the different elements for we need for this theme
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */


/**
 * Table of Contents:
 *
 * 1 - Theme setup
 * 2 - custom css nav menu
 * 3 - Include Styles and script
 * 4 - Separator Title
 * 5 - Hiden Version WP
 */

/**
 * 1 - Theme setup
 *     Function for perform basic setup, registration and init actions for customtheme
 */

// fonction qui vérifie si le 'myportfolio_supports' exixte déjà avant de l'initialiser
if(!function_exists('myportfolio_supports')){
    function myportfolio_supports(){
        // Let WordPress manage the document title.
        add_theme_support( "title-tag" );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // dimention image
        add_image_size('post-thumbnail', 350, 215, true);

        // This customtheme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top' => esc_html__( 'Top', 'Nav-top' ),
            'aside' => esc_html__( 'Aside', 'Nav-vertical' ),
            //'footer' => __( 'Footer', 'Pied de page' )
        ) );

        // Make customtheme available for translation. Translations can be filed in the /languages/ directory.
        load_theme_textdomain( 'MyCV', get_template_directory() . '/languages' );
    }
}
add_action('after_setup_theme','myportfolio_supports' );

/**
 * 2 - Custom css nav menu
 *     nav_menu_css_class: Filters the CSS classes applied to a menu item’s list item components.
 *     nav_menu_link_attributes: Filters the HTML attributes applied to a menu item’s anchor components.
 */
add_filter(
    "nav_menu_css_class",
    function($classes){
        $classes[] = 'nav-item';
        return $classes;
    }
);

add_filter(
    "nav_menu_link_attributes",
    function($attrs){
        $attrs['class'] = 'nav-link';
        //$attrs['class'] = 'nav-link scrollto';
        return $attrs;
    }
);



/**
 * 4 - Separator Title
 *     Filters the separator for the document title
 */
if(!function_exists('myportfolio_title_separator')){
    function myportfolio_title_separator(){
        return '|';
    }
}
add_filter( 'document_title_separator', 'myportfolio_title_separator');

/**
 * 5 - Hiden Version WP
 */
//	Securité : Cacher la verion du WordPress utilisé
function myportfolio_remove_version_strings( $src ) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

add_filter( 'script_loader_src', 'myportfolio_remove_version_strings' );
add_filter( 'style_loader_src', 'myportfolio_remove_version_strings' );

// Hide WP version strings from generator meta tag
function myportfolio_remove_version() {
    return '';
}

add_filter('the_generator', 'myportfolio_remove_version');