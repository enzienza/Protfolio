<?php
/**
 * Name file: 06-contact
 * Description: this file allows to manage display of the contact section
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

class mycustome_contact{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_contact';
    const NONCE        = '_mycustome_contact';

    //definir les sections de la page d'option
    const CONTACT_MANAGEMENT  = "contact_management";


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
            __('Contact', 'MyPortfolio'),            // page_title
            __('Contact', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser contact", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section contact du site', 'MyPortfolio') ?>
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
         * SECTION 1 : CONTACT_MANAGEMENT ============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::CONTACT_MANAGEMENT,                 // SLUG_SECTION
            __('Gérer la section', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_contact_management'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'contact_hidden',                        // SLUG_FIELD
            __('Cacher la section', 'MyPortfolio'),  // LABEL
            [self::class,'field_contact_hidden'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CONTACT_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'contact_title',                        // SLUG_FIELD
            __('Titre section', 'MyPortfolio'),  // LABEL
            [self::class,'field_contact_title'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CONTACT_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'contact_description',                        // SLUG_FIELD
            __('Description section', 'MyPortfolio'),  // LABEL
            [self::class,'field_contact_description'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CONTACT_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'contact_network',                        // SLUG_FIELD
            __('Réseaux sociaux', 'MyPortfolio'),  // LABEL
            [self::class,'field_contact_network'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::CONTACT_MANAGEMENT                // SLUG_SECTION
        );
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'contact_hidden_section');
        // title
        register_setting(self::SUB_GROUP, 'contact_title_fr');
        register_setting(self::SUB_GROUP, 'contact_title_en');
        register_setting(self::SUB_GROUP, 'contact_title_it');
        // description
        register_setting(self::SUB_GROUP, 'contact_show_desc');
        register_setting(self::SUB_GROUP, 'contact_desc_fr');
        register_setting(self::SUB_GROUP, 'contact_desc_en');
        register_setting(self::SUB_GROUP, 'contact_desc_it');
        //network
        register_setting(self::SUB_GROUP, 'contact_network');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : CONTACT_MANAGEMENT ============================================
    public static function display_section_contact_management(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyPortfolio") ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : CONTACT_MANAGEMENT ============================================
    
    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : CONTACT_MANAGEMENT ============================================
    public static function field_contact_hidden(){
        $contact_hidden_section = get_option('contact_hidden_section');
        ?>
        <input type="checkbox" id="contact_hidden_section" name="contact_hidden_section" value="1" <?php checked(1, $contact_hidden_section, true); ?> />
        <label for=""><?php _e("Masquer la section portfolio du thème", "MyPortfolio"); ?></label>
        <?php
    }
    public static function field_contact_title(){
        $contact_title_fr = esc_attr(get_option('contact_title_fr'));
        $contact_title_en = esc_attr(get_option('contact_title_en'));
        $contact_title_it = esc_attr(get_option('contact_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="contact_title_fr"
                       name="contact_title_fr"
                       value="<?php echo $contact_title_fr ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="contact_title_en"
                       name="contact_title_en"
                       value="<?php echo $contact_title_en ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="contact_title_it"
                       name="contact_title_it"
                       value="<?php echo $contact_title_it ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_contact_description(){
        $contact_show_desc = get_option('contact_show_desc');
        $contact_desc_fr = esc_attr(get_option('contact_desc_fr'));
        $contact_desc_en = esc_attr(get_option('contact_desc_en'));
        $contact_desc_it = esc_attr(get_option('contact_desc_it'));
        ?>
        <p>
            <input type="checkbox" id="contact_show_desc" name="contact_show_desc" value="1" <?php checked(1, $contact_show_desc, true) ?> />
            <label for=""><?php _e("Afficher une description à la section", "MyPortfolio"); ?></label>
        </p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <textarea name="contact_desc_fr" id="contact_desc_fr" placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"><?php echo $contact_desc_fr; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <textarea name="contact_desc_en" id="contact_desc_en" placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"><?php echo $contact_desc_en; ?></textarea>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <textarea name="contact_desc_it" id="contact_desc_it" placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"><?php echo $contact_desc_it; ?></textarea>
            </div>
        </div>
        <?php
    }
    public static function field_contact_network(){
        $contact_network = get_option('contact_network');
        ?>
        <input type="checkbox" id="contact_network" name="contact_network" value="1" <?php checked(1, $contact_network, true); ?> />
        <label for=""><?php _e(" Afficher les réseaux sociaux dans la section contact", "MyPortfolio"); ?></label>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_contact')){
    mycustome_contact::register();
}
