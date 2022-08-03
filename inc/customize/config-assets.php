<?php
/**
 * Name file: config-assets
 * Description: this is allows you to add the style and the différent scripts that we need for this theme
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */


// fonction qui vérifie si 'myportfolio_register_assets' exixte déjà avant de l'initialiser
if(!function_exists('myportfolio_register_assets')) {
    function myportfolio_register_assets()
    {

        // ===================================================================
        // CSS
        // ===================================================================

        /**
         * BOOTSTRAP - CSS
         *
         * @category CDN
         * @version 4.4.1
         */
        wp_register_style(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
            [], '4.4.1'
        );
        wp_enqueue_style('bootstrap');

        // STYLE CUSTOM  .....................................................
        /**
         * STYLE
         *
         * @description Custom Theme Style
         * @version 4.4.1
         */
        wp_enqueue_style(
            'style',
            get_template_directory_uri().'/style.css',
            [], '1.0.0'
        );


        // ===================================================================
        // JAVASCRIP
        // ===================================================================

        /**
         * BOOTSTRAP - JS
         *
         * @category CDN
         * @dependence ['popper', 'jquery']
         * @version 4.4.1
         */
        wp_register_script(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
            ['popper', 'jquery'],
            '4.4.1', true
        );

        /**
         * POPPER
         *
         * @category CDN
         * @dependence ['popper', 'jquery']
         * @version 1.16.0
         */
        wp_register_script(
            'popper',
            'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
            [],
            '1.16.0', true
        );
        wp_enqueue_script('bootstrap');

        /**
         * JQUERY-COOKIE
         *
         * @description Permet d'enregistre les cookie (il est utilise pour le swtich mode)
         * @category CDN
         * @dependence ['jquery']
         * @version 1.4.1
         */
        wp_register_script(
            'jquery-cookie',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
            ['jquery'],
            '1.4.1', true
        );
        wp_enqueue_script('jquery-cookie');


        // SCRIPT CUSTOM  ....................................................

        /**
         * SWITCH-MODE
         *
         * @description Permet de basculé du mode claire à sombre
         * @dependence ['jquery-cookie','jquery']
         * @version 1.0
         */
        wp_enqueue_script(
            'switch-mode',
            get_template_directory_uri().'/assets/js/switch-mode.js',
            ['jquery-cookie','jquery'],
            '1.0', true
        );

        /**
         * BTN-MENU
         *
         * @description Pour le responsive, permet d'afficher le menu + animation du BTN
         * @version 1.0
         */
        wp_enqueue_script(
            'btn-menu',
            get_template_directory_uri().'/assets/js/btn-menu.js',
            [],
            '1.0', true
        );

        /**
         * ANCESTOR_MENU
         *
         * @description Permet d'ajouter la classe "current-menu-ancestor" de WordPress
         * @version 1.0
         */
        wp_enqueue_script(
            'ancestor_menu',
            get_template_directory_uri().'/assets/js/ancestor-menu.js',
            [],
            '1.0', true
        );

        /**
         * SCROLLTOP
         *
         * @description Permet de remonté la page
         * @version 1.0
         */
        wp_enqueue_script(
            'scrollTop',
            get_template_directory_uri().'/assets/js/scrollTop.js',
            [],
            '1.0', true
        );

        /**
         * SCROLL-SHOW
         *
         * @description permet de visualise l'element au fure et a mesure du scroll
         * @version 1.2
         */
//        wp_enqueue_script(
//            'scroll-show',
//            get_template_directory_uri().'/assets/js/scroll-show.js',
//            [],
//            '1.2', true
//        );


        /**
         * JQUERY
         *
         * @category CDN
         * @version 3.5.1
         */
        wp_deregister_script('jquery');
        wp_register_script(
            'jquery',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
            [],
            '3.5.1', true
        );

    }
}
add_action('wp_enqueue_scripts', 'myportfolio_register_assets');