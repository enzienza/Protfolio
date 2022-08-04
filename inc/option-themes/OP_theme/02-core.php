<?php
/**
 * Name file: 02-core
 * Description: this file allows to manage display of the header and the footer
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

class mycustome_core{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_core';
    const NONCE        = '_mycustome_core';

    //definir les sections de la page d'option
    const CUSTOM_HEADER = "custom_header";
    const CUSTOM_FOOTER = "custom_footer";


    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        //add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_submenu_page(
            myportfolio_mycustome::GROUP,        // slug parent
            __('Core', 'MyCV'),            // page_title
            __('Core', 'MyCV'),             // menu_title
            self::PERMITION,              // capability
            self::SUB_GROUP,             // slug_menu
            [self::class, 'render']                // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Personnaliser le core', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer le core du site', 'MyCV') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::SUB_GROUP);
            do_settings_sections(self::SUB_GROUP);
            ?>
            <?php submit_button(); ?>
        </form>
        <?php
    }

    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
    public static function registerSettings(){
        /**
         * SECTION 1 : CUSTOM_HEADER ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::CUSTOM_HEADER,                 // SLUG_SECTION
            __('Gérer le header', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_custom_header'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'user_section',                        // SLUG_FIELD
            __('Section utilisateur', 'MyPortfolio'),  // LABEL
            [self::class,'field_user_section'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_HEADER                // SLUG_SECTION
        );
        add_settings_field(
            'user_element',                        // SLUG_FIELD
            __('Ce qui doit être présent', 'MyPortfolio'),  // LABEL
            [self::class,'field_user_element'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_HEADER                // SLUG_SECTION
        );
        add_settings_field(
            'user_picture',                        // SLUG_FIELD
            __('Choisir l\'image', 'MyPortfolio'),  // LABEL
            [self::class,'field_user_picture'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_HEADER                // SLUG_SECTION
        );
        add_settings_field(
            'user_network',                        // SLUG_FIELD
            __('Section social', 'MyPortfolio'),  // LABEL
            [self::class,'field_user_network'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_HEADER                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, "sidebar_hidden_user");
        register_setting(self::SUB_GROUP, "sidebar_user_lastname");
        register_setting(self::SUB_GROUP, "sidebar_user_firstname");
        register_setting(self::SUB_GROUP, "sidebar_user_job");
        register_setting(self::SUB_GROUP, "sidebar_user_picture");
        register_setting(self::SUB_GROUP, "sidebar_choose_picture");
        register_setting(self::SUB_GROUP, "sidebar_network");

        /**
         * SECTION 2 : CUSTOM_FOOTER ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::CUSTOM_FOOTER,                 // SLUG_SECTION
            __('Gérer le footer', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_custom_footer'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'footer_type',                        // SLUG_FIELD
            __('Type', 'MyPortfolio'),              // LABEL
            [self::class,'field_footer_type'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_FOOTER                // SLUG_SECTION
        );
        add_settings_field(
            'footer_format',                        // SLUG_FIELD
            __('Copyright', 'MyPortfolio'),             // LABEL
            [self::class,'field_footer_format'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_FOOTER                // SLUG_SECTION
        );
        add_settings_field(
            'footer_element',                        // SLUG_FIELD
            __('Partie légale', 'MyPortfolio'),  // LABEL
            [self::class,'field_footer_element'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CUSTOM_FOOTER                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, "footer_type");
        register_setting(self::SUB_GROUP, "footer_format");
        register_setting(self::SUB_GROUP, "display_privacy");
        register_setting(self::SUB_GROUP, "display_cookie");
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : CUSTOM_HEADER ========================================
    public static function display_section_custom_header(){
        ?>
        <?php _e("Dans cette section, vous pouvez gérer tous les éléments du header", "MyPortfolio"); ?>
        <?php
    }
    // SECTION 2 : CUSTOM_FOOTER ========================================
    public static function display_section_custom_footer(){
        ?>
        <?php _e("Dans cette section, vous pouvez gérer tous les éléments du footer", "MyPortfolio"); ?>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : CUSTOM_HEADER ========================================
    // SECTION 2 : CUSTOM_FOOTER ========================================

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : CUSTOM_HEADER ========================================
    public static function field_user_section(){
        $sidebar_hidden_user = get_option("sidebar_hidden_user");
        ?>
        <div>
            <input type="checkbox" id="sidebar_hidden_user" name="sidebar_hidden_user" value="1" <?php checked(1, $sidebar_hidden_user, true); ?> />
            <label for=""><?php _e("Cacher la section utilisateur de la sidebar", "MyPortfolio"); ?></label>
        </div>
        <?php
    }
    public static function field_user_element(){
        $sidebar_user_lastname = get_option("sidebar_user_lastname");
        $sidebar_user_firstname = get_option("sidebar_user_firstname");
        $sidebar_user_job = get_option("sidebar_user_job");
        $sidebar_user_picture = get_option("sidebar_user_picture");
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyPortfolio") ?></p>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="sidebar_user_lastname" name="sidebar_user_lastname" value="1" <?php checked(1, $sidebar_user_lastname, true); ?>  />
                <label for=""><?php _e("Nom", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="sidebar_user_firstname" name="sidebar_user_firstname" value="1" <?php checked(1, $sidebar_user_firstname, true); ?>  />
                <label for=""><?php _e("Prénom", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="sidebar_user_job" name="sidebar_user_job" value="1" <?php checked(1, $sidebar_user_job, true); ?>  />
                <label for=""><?php _e("Job", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="sidebar_user_picture" name="sidebar_user_picture" value="1" <?php checked(1, $sidebar_user_picture, true); ?>  />
                <label for=""><?php _e("Photo", "MyPortfolio"); ?></label>
            </li>
        </ul>
        <?php
    }
    public static function field_user_picture(){
        $sidebar_choose_picture = get_option("sidebar_choose_picture");
        ?>
        <p class="description"><?php _e("Uniquement si photo est chocher", "MyPortfolio") ?></p>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="radio" name="sidebar_choose_picture" value="1" <?php checked(1, $sidebar_choose_picture, true); ?>  />
                <label for=""><?php _e("Profil", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="radio" name="sidebar_choose_picture" value="2" <?php checked(2, $sidebar_choose_picture, true); ?>  />
                <label for=""><?php _e("Avatar", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="radio" name="sidebar_choose_picture" value="3" <?php checked(3, $sidebar_choose_picture, true); ?>  />
                <label for=""><?php _e("Logo", "MyPortfolio"); ?></label>
            </li>
        </ul>
        <?php
    }
    public static function field_user_network(){
        $sidebar_network = get_option("sidebar_network");
        ?>
        <div>
            <input type="checkbox" id="sidebar_network" name="sidebar_network" value="1" <?php checked(1, $sidebar_network, true); ?> />
            <label for=""><?php _e("Cacher la section réseaux sociaux de la sidebar", "MyPortfolio"); ?></label>
        </div>
        <?php
    }

    // SECTION 2 : CUSTOM_FOOTER ========================================
    public static function field_footer_type(){
        $footer_type = get_option("footer_type");
        ?>
        <p class="description"><?php _e("Choisir le type de footer à afficher", "MyPortfolio") ?></p>
        <div class="choose-item space-y-2">
            <input type="radio" name="footer_type" value="1" <?php checked(1, $footer_type, true) ?> />
            <label for=""><?php _e("Uniquement le copyright", "MyPortfolio") ?></label>
        </div>
        <div class="choose-item">
            <input type="radio" name="footer_type" value="2" <?php checked(2, $footer_type, true) ?> />
            <label for=""><?php _e("Copyright + Partie légale", "MyPortfolio") ?></label>
        </div>
        <?php
    }
    public static function field_footer_format(){
        $footer_format = get_option("footer_format");
        ?>
        <p class="description"><?php _e("Choisir le format du copyright à afficher", "MyPortfolio") ?></p>
        <div class="choose-item space-y-2">
            <input type="radio" name="footer_format" value="1" <?php checked(1, $footer_format, true); ?> />
            <label for=""><?php _e('"name-Theme" © 2022 | Created by Enza Lombardo', "MyPortfolio"); ?></label>
        </div>
        <div class="choose-item">
            <input type="radio" name="footer_format" value="2" <?php checked(2, $footer_format, true); ?> />
            <label for=""><?php _e('Copyright ©  2022 Enza | All rights reserved', "MyPortfolio"); ?></label>
        </div>
        <?php
    }
    public static function field_footer_element(){
        $display_privacy = get_option("display_privacy");
        $display_cookie = get_option("display_cookie");
        ?>
        <p class="description"><?php _e("Choisir les mentions légals à afficher | Uniquement si Partie légale est coché", "MyPortfolio") ?></p>
        <div class="choose-item space-y-2">
            <input type="checkbox" id="display_privacy" name="display_privacy" value="1" <?php checked(1, $display_privacy, true); ?> />
            <label for=""><?php _e('Mentions légales', "MyPortfolio"); ?></label>
        </div>
        <div class="choose-item space-y-2">
            <input type="checkbox" id="display_cookie" name="display_cookie" value="1" <?php checked(1, $display_cookie, true); ?> />
            <label for=""><?php _e('Cookies', "MyPortfolio"); ?></label>
        </div>

        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_core')){
    mycustome_core::register();
}
