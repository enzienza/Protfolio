<?php
/**
 * Name file: 07-errorpage
 * Description: this file allows to manage display of the errorpage section
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

class mycustome_errorpage{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_errorpage';
    const NONCE        = '_mycustome_errorpage';

    //definir les sections de la page d'option
    const ERRORPAGE_MANAGEMENT  = "errorpage_management";
    const ERRORPAGE_MESSAGE     = "errorpage_message";

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
            __('Error page', 'MyPortfolio'),            // page_title
            __('Error page', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser la page d'erreur 404", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer la section la page d'erreur 404 du site", 'MyPortfolio') ?>
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
         * SECTION 1 : ERRORPAGE_MANAGEMENT =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::ERRORPAGE_MANAGEMENT,                 // SLUG_SECTION
            __('Gérer la section', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_contact_errorpage_management'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'element_errorpage',                        // SLUG_FIELD
            __('Ce qui doit être présent', 'MyPortfolio'),  // LABEL
            [self::class,'field_element_errorpage'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ERRORPAGE_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'type_error',                        // SLUG_FIELD
            __('Type d\'erreur', 'MyPortfolio'),  // LABEL
            [self::class,'field_type_error'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ERRORPAGE_MANAGEMENT                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, "errorpage_back_home");



        /**
         * SECTION 2 : ERRORPAGE_MESSAGE ===========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::ERRORPAGE_MESSAGE,                 // SLUG_SECTION
            __('Gérer les messages', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_errorpage_message'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'errorpage_maintext',                        // SLUG_FIELD
            __('Texte principal', 'MyPortfolio'),  // LABEL
            [self::class,'field_errorpage_maintext'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ERRORPAGE_MESSAGE                // SLUG_SECTION
        );
        add_settings_field(
            'errorpage_message',                        // SLUG_FIELD
            __('Message d\'erreur', 'MyPortfolio'),  // LABEL
            [self::class,'field_errorpage_message'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ERRORPAGE_MESSAGE                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        // maintext
        register_setting(self::SUB_GROUP, "teaser_error_fr");
        register_setting(self::SUB_GROUP, "teaser_error_en");
        register_setting(self::SUB_GROUP, "teaser_error_it");
        // message
        register_setting(self::SUB_GROUP, "message_error_fr");
        register_setting(self::SUB_GROUP, "message_error_en");
        register_setting(self::SUB_GROUP, "message_error_it");

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : ERRORPAGE_MANAGEMENT =======================================
    public static function display_section_contact_errorpage_management(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage des éléments présent dans la section", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 2 : ERRORPAGE_FR ===============================================
    public static function display_section_errorpage_message(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage des messages présent dans la section", "MyPortfolio") ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : ERRORPAGE_MANAGEMENT =======================================
    public static function field_element_errorpage(){
        $errorpage_back_home = get_option('errorpage_back_home');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyPortfolio"); ?></p>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="errorpage_back_home" name="errorpage_back_home" value="1" <?php checked(1, $errorpage_back_home, true) ?> />
                <label><?php _e("Button page d'accueil", "MyPortfolio"); ?></label>
            </li>
        </ul>
        <?php
    }
    public static function field_type_error(){
        ?>
        <p class="description"><?php _e("Erreur 404", "MyPortfolio"); ?></p>
        <?php
    }
    // SECTION 2 : ERRORPAGE_FR ===============================================
    public static function field_errorpage_maintext(){
        $teaser_error_fr = esc_attr(get_option('teaser_error_fr'));
        $teaser_error_en = esc_attr(get_option('teaser_error_en'));
        $teaser_error_it = esc_attr(get_option('teaser_error_it'));
        ?>
        <p class="description"><?php _e("Définir le message d'accroche", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="teaser_error_fr"
                       name="teaser_error_fr"
                       value="<?php echo $teaser_error_fr ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="teaser_error_en"
                       name="teaser_error_en"
                       value="<?php echo $teaser_error_en ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="teaser_error_it"
                       name="teaser_error_it"
                       value="<?php echo $teaser_error_it ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_errorpage_message(){
        $message_error_fr = esc_attr(get_option('message_error_fr'));
        $message_error_en = esc_attr(get_option('message_error_en'));
        $message_error_it = esc_attr(get_option('message_error_it'));
        ?>
        <p class="description"><?php _e("Définir le message d'erreur", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <textarea id="message_error_fr" name="message_error_fr" placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"><?php echo $message_error_fr; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <textarea id="message_error_en" name="message_error_en" placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"><?php echo $message_error_en; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <textarea id="message_error_it" name="message_error_it" placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"><?php echo $message_error_it; ?></textarea>
            </div>
        </div>
        <?php
    }
    // SECTION 3 : ERRORPAGE_EN ===============================================
    // SECTION 4 : ERRORPAGE_IT ===============================================

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_errorpage')){
    mycustome_errorpage::register();
}
