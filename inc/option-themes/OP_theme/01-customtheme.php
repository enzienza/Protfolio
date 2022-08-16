<?php
/**
 * Name file: 01-customtheme
 * Description: this file is an index of the different links that allows you to manage the theme
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */

/**
 * Table of Contents:
 *
 * 1 - DEFINIR LES ELEMENTS (repeter)
 * 2 - DEFINIR LES HOOKS ACTIONS
 * 3 - CONSTRUCTION DE LA PAGE
 * 4 - TEMPLATE DES PAGES
 * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
 * 6 - DEFINIR LES SECTIONS DE LA PAGE
 * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
 * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
 * 9 - AJOUT STYLE & SCRIPT
 */

class myportfolio_mycustome{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-admin-multisite';
    const GROUP      = 'mycustome';
    const NONCE      = '_mycustome';

    //definir les sections de la page d'option
    const SECTION_DETAIL = 'section_detail';
    const SECTION_LOCATION = 'section_location';
    const SECTION_POST = 'section_post';


    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        //add_action('admin_init', [self::class, 'registerSettings']);
        //add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_menu_page(
            __('Mon thème', 'MyPortfolio'),       // TITLE_PAGE
            __('Mon thème', 'MyPortfolio'),        // TITLE_MENU
            self::PERMITION,           // CAPABILITY
            self::GROUP,              // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,             // icon
            4                           // POSITION
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e("Page d'option du theme", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les différents éléments de notre theme', 'MyPortfolio') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <table class="widefat importers striped">

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e('Core', "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=mycustome_core" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer l'affichage de l'header et du footer", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e('Home', "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=mycustome_home" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer la section de l'home", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e('about', "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=mycustome_about" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer la section l'about", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e('Portfolio', "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer la section portfolio", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e('Contact', "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer la section contact", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->

            <!-- start tr -->
            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title"><?php _e("Page d'erreur", "MyPortfolio")?></span>
                    <span class="importer-action">
                      <a href="?page=" class="install-now"><?php _e("Gérer la section", "MyPortfolio"); ?></a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      <?php _e("Lien pour gérer l'affichage de la page d'erreur", "MyPortfolio"); ?>
                    </span>
                </td>
            </tr><!-- end tr -->
        </table>
        <?php
    }

    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
//    public static function registerSettings(){}

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */



    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myportfolio_mycustome')){
    myportfolio_mycustome::register();
}