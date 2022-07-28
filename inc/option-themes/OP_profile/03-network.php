<?php
/**
 * Name file: 03-network
 * Description: this file allows to manage the different contact via social network
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

class myprofil_network{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'myprofil_network';
    const NONCE        = '_myprofil_network';

    //definir les sections de la page d'option
    const SECTION_SOCIAL = "section_social";


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
            myportfolio_myprofil::GROUP,        // slug parent
            __('Mes réseaux', 'MyPortfolio'),            // page_title
            __('Mes réseaux', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Mes réseaux sociaux', 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les url de vos réseaux sociaux', 'MyPortfolio') ?>
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
         * SECTION 1 : SECTION_SOCIAL ===================================
         *             -> Créer la section
         *             -> Ajouter les éléments du formulaire
         *             -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_SOCIAL,                 // SLUG_SECTION
            __('Mes réseaux sociaux', 'MyPortfolio'),        // TITLE
            [self::class, 'display_section_social'],  // CALLBACK
            self::SUB_GROUP                     // SLUG_PAGE
        );

        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'myfacebook',                          // SLUG_FIELD
            __('Facebook', 'MyPortfolio'),                    // LABEL
            [self::class,'field_myfacebook'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'mytwitter',                          // SLUG_FIELD
            __('Twitter', 'MyPortfolio'),                    // LABEL
            [self::class,'field_mytwitter'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'myinstagram',                          // SLUG_FIELD
            __('Instagram', 'MyPortfolio'),                    // LABEL
            [self::class,'field_myinstagram'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'mylinkedin',                          // SLUG_FIELD
            __('LinkedIn', 'MyPortfolio'),                    // LABEL
            [self::class,'field_mylinkedin'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'mybehance',                          // SLUG_FIELD
            __('Behance', 'MyPortfolio'),                    // LABEL
            [self::class,'field_mybehance'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'mygithub',                          // SLUG_FIELD
            __('GitHub', 'MyPortfolio'),                    // LABEL
            [self::class,'field_mygithub'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        add_settings_field(
            'mysiteweb',                          // SLUG_FIELD
            __('Site Web', 'MyPortfolio'),                    // LABEL
            [self::class,'field_mysiteweb'],          // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_SOCIAL                // SLUG_SECTION
        );

        // -> Sauvegarder les
        register_setting(self::SUB_GROUP,'display_myfacebook');
        register_setting(self::SUB_GROUP,'myfacebook');
        register_setting(self::SUB_GROUP,'display_mytwitter');
        register_setting(self::SUB_GROUP,'mytwitter');
        register_setting(self::SUB_GROUP,'display_myinstagram');
        register_setting(self::SUB_GROUP,'myinstagram');
        register_setting(self::SUB_GROUP,'display_mylinkedin');
        register_setting(self::SUB_GROUP,'mylinkedin');
        register_setting(self::SUB_GROUP,'display_mybehance');
        register_setting(self::SUB_GROUP,'mybehance');
        register_setting(self::SUB_GROUP,'display_mygithub');
        register_setting(self::SUB_GROUP,'mygithub');
        register_setting(self::SUB_GROUP,'display_mysiteweb');
        register_setting(self::SUB_GROUP,'mysiteweb');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_SOCIAL ===========================================
    public static function display_section_social(){
        ?>
        <p class="section-description">
            <?php _e('Cocher et ajouter l\'url de vos réseaux sociaux', 'MyPortfolio') ?>
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
    // SECTION 1 : SECTION_SOCIAL ===========================================
    public static function field_myfacebook(){
        $display_myfacebook = esc_attr(get_option('display_myfacebook'));
        $myfacebook = esc_attr(get_option('myfacebook'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_myfacebook"
                   name="display_myfacebook"
                   value="1"
                <?php checked( 1, $display_myfacebook, true); ?>
            />
            <input type="url"
                   id="myfacebook"
                   name="myfacebook"
                   value="<?php echo $myfacebook ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_mytwitter(){
        $display_mytwitter = esc_attr(get_option('display_mytwitter'));
        $mytwitter = esc_attr(get_option('mytwitter'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_mytwitter"
                   name="display_mytwitter"
                   value="1"
                <?php checked( 1, $display_mytwitter, true); ?>
            />
            <input type="url"
                   id="mytwitter"
                   name="mytwitter"
                   value="<?php echo $mytwitter ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_myinstagram(){
        $display_myinstagram = esc_attr(get_option('display_myinstagram'));
        $myinstagram = esc_attr(get_option('myinstagram'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_myinstagram"
                   name="display_myinstagram"
                   value="1"
                <?php checked( 1, $display_myinstagram, true); ?>
            />
            <input type="url"
                   id="myinstagram"
                   name="myinstagram"
                   value="<?php echo $myinstagram ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_mylinkedin(){
        $display_mylinkedin = esc_attr(get_option('display_mylinkedin'));
        $mylinkedin = esc_attr(get_option('mylinkedin'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_mylinkedin"
                   name="display_mylinkedin"
                   value="1"
                <?php checked( 1, $display_mylinkedin, true); ?>
            />
            <input type="url"
                   id="mylinkedin"
                   name="mylinkedin"
                   value="<?php echo $mylinkedin ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_mybehance(){
        $display_mybehance = esc_attr(get_option('display_mybehance'));
        $mybehance = esc_attr(get_option('mybehance'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_mybehance"
                   name="display_mybehance"
                   value="1"
                <?php checked( 1, $display_mybehance, true); ?>
            />
            <input type="url"
                   id="mybehance"
                   name="mybehance"
                   value="<?php echo $mybehance ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_mygithub(){
        $display_mygithub = esc_attr(get_option('display_mygithub'));
        $mygithub = esc_attr(get_option('mygithub'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_mygithub"
                   name="display_mygithub"
                   value="1"
                <?php checked( 1, $display_mygithub, true); ?>
            />
            <input type="url"
                   id="mygithub"
                   name="mygithub"
                   value="<?php echo $mygithub ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }
    public static function field_mysiteweb(){
        $display_mysiteweb = esc_attr(get_option('display_mysiteweb'));
        $mysiteweb = esc_attr(get_option('mysiteweb'));
        ?>
        <div class="flex align-center">
            <input type="checkbox"
                   id="display_mysiteweb"
                   name="display_mysiteweb"
                   value="1"
                <?php checked( 1, $display_mysiteweb, true); ?>
            />
            <input type="url"
                   id="mysiteweb"
                   name="mysiteweb"
                   value="<?php echo $mysiteweb ?>"
                   class="regular-text"
                   placeholder="https://example.com"
            />
        </div>
        <?php
    }


    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myprofil_network')){
    myprofil_network::register();
}