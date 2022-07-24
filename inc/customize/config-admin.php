<?php
/**
 * Name file: config-admin
 * Description: this file allows you customize style the dashboard
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */


/**
 * Table of Contents:
 *
 * 1 - Custom Page Admin
 * 2 - Custom Link Login
 * 3 - Custom alt
 * 4 - Custom Administration
 */



/**
 * 1 - Custom Page Admin
 *     Function that allow to customize the login page
 */

if(!function_exists('custom_login')) {
    function custom_login()
    {
        wp_enqueue_style(
            'montheme_admin',
            get_template_directory_uri() . '/assets/css/admin.css',
            array('login')
        );
    }
}
add_action('login_enqueue_scripts', 'custom_login');

/**
 * 2 - Custom Link Login
 *     Function to customize the logo link on the login page
 */
if(!function_exists('custom_logo_link')){
    function custom_logo_link(){
        return get_bloginfo('siteurl');
    }
}
add_filter('login_headerurl', 'custom_logo_link');

/**
 * 3 - Custom alt
 *     Function to custom the alt property of the img tag (logo) on the login page
 */
if(!function_exists('custom_logo_title')) {
    function custom_logo_title()
    {
        return get_bloginfo('description');
    }
}
add_filter('login_headertitle', 'custom_logo_title');

/**
 * 4 - Custom Administration
 *     Function customize the CSS on the administration
 */
if(!function_exists('custom_admin')) {
    function custom_admin()
    {
        // CUSTOM CSS - Personnaliser l'administration
        wp_enqueue_style(
            'montheme_admin',
            get_template_directory_uri() . '/assets/css/admin.css'
        );
    }
}
add_action('admin_enqueue_scripts', 'custom_admin');