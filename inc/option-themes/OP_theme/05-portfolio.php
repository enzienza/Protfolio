<?php
/**
 * Name file: 05-portfolio
 * Description: this file allows to manage display of the portfolio section
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

class mycustome_portfolio{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_portfolio';
    const NONCE        = '_mycustome_portfolio';

    //definir les sections de la page d'option
    const PORTFOLIO_MANAGEMENT  = "portfolio_management";
    const PORTFOLIO_LOOP        = "portfolio_loop";


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
            __('Portfolio', 'MyPortfolio'),            // page_title
            __('Portfolio', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser portfolio", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section portfolio du site', 'MyPortfolio') ?>
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
         * SECTION 1 : PORTFOLIO_MANAGEMENT ==========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::PORTFOLIO_MANAGEMENT,                 // SLUG_SECTION
            __('Gérer la section', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_portfolio_management'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'portfolio_hidden',                        // SLUG_FIELD
            __('Cacher la section', 'MyPortfolio'),  // LABEL
            [self::class,'field_portfolio_hidden'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::PORTFOLIO_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'portfolio_title',                        // SLUG_FIELD
            __('Titre section', 'MyPortfolio'),  // LABEL
            [self::class,'field_portfolio_title'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::PORTFOLIO_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'portfolio_description',                        // SLUG_FIELD
            __('Description section', 'MyPortfolio'),  // LABEL
            [self::class,'field_portfolio_description'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::PORTFOLIO_MANAGEMENT                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'portfolio_hidden_section');
        // title
        register_setting(self::SUB_GROUP, 'portfolio_title_fr');
        register_setting(self::SUB_GROUP, 'portfolio_title_en');
        register_setting(self::SUB_GROUP, 'portfolio_title_it');
        // description
        register_setting(self::SUB_GROUP, 'portfolio_show_desc');
        register_setting(self::SUB_GROUP, 'portfolio_desc_fr');
        register_setting(self::SUB_GROUP, 'portfolio_desc_en');
        register_setting(self::SUB_GROUP, 'portfolio_desc_it');

        /**
         * SECTION 2 : PORTFOLIO_LOOP ================================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::PORTFOLIO_LOOP,                 // SLUG_SECTION
            __('Gérer la boucle', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_portfolio_loop'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'portfolio_emoji_loop',                        // SLUG_FIELD
            __('Émoji', 'MyPortfolio'),  // LABEL
            [self::class,'field_portfolio_emoji_loop'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::PORTFOLIO_LOOP                // SLUG_SECTION
        );
        add_settings_field(
            'portfolio_msg_loop',                        // SLUG_FIELD
            __('Message boucle', 'MyPortfolio'),  // LABEL
            [self::class,'field_portfolio_msg_loop'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::PORTFOLIO_LOOP                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'portfolio_loop_emoji');
        // msg loop
        register_setting(self::SUB_GROUP, 'portfolio_loop_fr');
        register_setting(self::SUB_GROUP, 'portfolio_loop_it');
        register_setting(self::SUB_GROUP, 'portfolio_loop_en');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : PORTFOLIO_MANAGEMENT ==========================================
    public static function display_section_portfolio_management(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 2 : PORTFOLIO_LOOP ================================================
    public static function display_section_portfolio_loop(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer la boucle", "MyPortfolio") ?>
        </p>
        <?php
    }


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : PORTFOLIO_MANAGEMENT ==========================================
    // SECTION 2 : PORTFOLIO_LOOP ================================================

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : PORTFOLIO_MANAGEMENT ==========================================
    public static function field_portfolio_hidden(){
        $portfolio_hidden_section = get_option('portfolio_hidden_section');
        ?>
        <input type="checkbox" id="portfolio_hidden_section" name="portfolio_hidden_section" value="1" <?php checked(1, $portfolio_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section portfolio du thème", "MyPortfolio"); ?></label>
        <?php
    }
    public static function field_portfolio_title(){
        $portfolio_title_fr = esc_attr(get_option('portfolio_title_fr'));
        $portfolio_title_en = esc_attr(get_option('portfolio_title_en'));
        $portfolio_title_it = esc_attr(get_option('portfolio_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_title_fr"
                       name="portfolio_title_fr"
                       value="<?php echo $portfolio_title_fr ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_title_en"
                       name="portfolio_title_en"
                       value="<?php echo $portfolio_title_en ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_title_it"
                       name="portfolio_title_it"
                       value="<?php echo $portfolio_title_it ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
            </div>
        </div>
        <?php
    }

    public static function field_portfolio_description(){
        $portfolio_show_desc = get_option('portfolio_show_desc');
        $portfolio_desc_fr = esc_attr(get_option('portfolio_desc_fr'));
        $portfolio_desc_en = esc_attr(get_option('portfolio_desc_en'));
        $portfolio_desc_it = esc_attr(get_option('portfolio_desc_it'));
        ?>
        <p>
            <input type="checkbox" id="portfolio_show_desc" name="portfolio_show_desc" value="1" <?php checked(1, $portfolio_show_desc, true) ?> />
            <label for=""><?php _e("Afficher une description à la section", "MyPortfolio"); ?></label>
        </p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <textarea name="portfolio_desc_fr" id="portfolio_desc_fr" placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"><?php echo $portfolio_desc_fr; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <textarea name="portfolio_desc_en" id="portfolio_desc_en" placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"><?php echo $portfolio_desc_en; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <textarea name="portfolio_desc_it" id="portfolio_desc_it" placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"><?php echo $portfolio_desc_it; ?></textarea>
            </div>
        </div>
        <?php
    }

    // SECTION 2 : PORTFOLIO_LOOP ================================================
    public static function field_portfolio_emoji_loop(){
        $portfolio_loop_emoji = get_option('portfolio_loop_emoji');
        ?>
        <input type="checkbox" id="portfolio_loop_emoji" name="portfolio_loop_emoji" value="1" <?php checked(1, $portfolio_loop_emoji, true) ?> />
        <label for=""><?php _e("Afficher l'émoji", "MyPortfolio"); ?> &#128549;</label>
        <?php
    }
    public static function field_portfolio_msg_loop(){
        $portfolio_loop_fr = esc_attr(get_option('portfolio_loop_fr'));
        $portfolio_loop_it = esc_attr(get_option('portfolio_loop_it'));
        $portfolio_loop_en = esc_attr(get_option('portfolio_loop_en'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle est vide", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_loop_fr"
                       name="portfolio_loop_fr"
                       value="<?php echo $portfolio_loop_fr; ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_loop_it"
                       name="portfolio_loop_it"
                       value="<?php echo $portfolio_loop_it; ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="portfolio_loop_en"
                       name="portfolio_loop_en"
                       value="<?php echo $portfolio_loop_en; ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
            </div>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_portfolio')){
    mycustome_portfolio::register();
}