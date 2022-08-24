<?php
/**
 * Name file: 03-home
 * Description: this file allows to manage display of the home section
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

class mycustome_home{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_home';
    const NONCE        = '_mycustome_home';

    //definir les sections de la page d'option
    const HERO_MANAGEMENT = "hero_management";
    const HERO_SALUTATION = "hero_salutation";
    const HERO_JOB        = "hero_job";
    const HERO_ABOUT      = "hero_about";
    const HERO_ACTION     = "hero_action";


    
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
            __('Home', 'MyPortfolio'),            // page_title
            __('Home', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser l'accueil", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section accueil du site', 'MyPortfolio') ?>
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
         * SECTION 1 : HERO_MANAGEMENT ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::HERO_MANAGEMENT,                 // SLUG_SECTION
            __('Bannière', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_hero_manage'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_hidden',                        // SLUG_FIELD
            __('Cacher la section', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_hidden'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'hero_image',                        // SLUG_FIELD
            __('Image en arrière plan', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_image'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_MANAGEMENT                // SLUG_SECTION
        );
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_hidden_section');
        register_setting(self::SUB_GROUP, 'add_bg_hero');
        register_setting(self::SUB_GROUP, 'bg_hero', [self::class, "handle_hero_upload"]);

        /**
         * SECTION 2 : HERO_SALUTATION ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::HERO_SALUTATION,                 // SLUG_SECTION
            __('Intro', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_hero_salutation'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_greeting',                        // SLUG_FIELD
            __('Format', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_greeting'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_SALUTATION                // SLUG_SECTION
        );
        add_settings_field(
            'hero_element',                        // SLUG_FIELD
            __('Ce qui doit être présent', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_element'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_SALUTATION                // SLUG_SECTION
        );
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'choose_format');
        // format 1
        register_setting(self::SUB_GROUP, 'hero_greeting_fr');
        register_setting(self::SUB_GROUP, 'hero_greeting_en');
        register_setting(self::SUB_GROUP, 'hero_greeting_it');
        // format 2
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_en');
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_it');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_en');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_it');
        // show name
        register_setting(self::SUB_GROUP, 'hero_show_lastname');
        register_setting(self::SUB_GROUP, 'hero_show_firsrname');

        /**
         * SECTION 3 : HERO_JOB ===============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::HERO_JOB,                 // SLUG_SECTION
            __('Job', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_hero_job'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_job_hidden',                        // SLUG_FIELD
            __('Cacher la section', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_job_hidden'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_JOB                // SLUG_SECTION
        );
        add_settings_field(
            'hero_job_message',                        // SLUG_FIELD
            __('Message', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_job_message'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_JOB                // SLUG_SECTION
        );
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_hidden_job');
        register_setting(self::SUB_GROUP, 'hero_msg_job_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_job_en');
        register_setting(self::SUB_GROUP, 'hero_msg_job_it');

        /**
         * SECTION 4 : HERO_ABOUT =============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::HERO_ABOUT,                 // SLUG_SECTION
            __('about', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_hero_about'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_job_about',                        // SLUG_FIELD
            __('Gestion', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_job_about'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_ABOUT                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_show_about_fr');
        register_setting(self::SUB_GROUP, 'hero_show_about_en');
        register_setting(self::SUB_GROUP, 'hero_show_about_it');

        /**
         * SECTION 5 : HERO_ACTION ============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::HERO_ACTION,                 // SLUG_SECTION
            __('Call to action', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_hero_action'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_btn_about',                        // SLUG_FIELD
            __('About', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_btn_about'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_ACTION                // SLUG_SECTION
        );
        add_settings_field(
            'hero_btn_download',                        // SLUG_FIELD
            __('Download CV', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_btn_download'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_ACTION                // SLUG_SECTION
        );
        add_settings_field(
            'hero_btn_contact',                        // SLUG_FIELD
            __('Contact', 'MyPortfolio'),  // LABEL
            [self::class,'field_hero_btn_contact'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::HERO_ACTION                // SLUG_SECTION
        );
        // 3. Sauvegarder les champs
        // About
        register_setting(self::SUB_GROUP, 'hero_btn_about');
        register_setting(self::SUB_GROUP, 'hero_icon_about');
        // Download
        register_setting(self::SUB_GROUP, 'hero_btn_download');
        register_setting(self::SUB_GROUP, 'hero_icon_download');
        // Contact
        register_setting(self::SUB_GROUP, 'hero_btn_contact');
        register_setting(self::SUB_GROUP, 'hero_icon_contact');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : HERO_MANAGEMENT ========================================
    public static function display_section_hero_manage(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la bannière", "MyPortfolio"); ?>
        </p>
        <?php
    }
    // SECTION 2 : HERO_SALUTATION ========================================
    public static function display_section_hero_salutation(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de l'introduction / salutation", "MyPortfolio"); ?>
        </p>
        <?php
    }
    // SECTION 3 : HERO_JOB ===============================================
    public static function display_section_hero_job(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage du métier visé", "MyPortfolio"); ?>
        </p>
        <?php
    }
    // SECTION 4 : HERO_ABOUT =============================================
    public static function display_section_hero_about(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de about", "MyPortfolio"); ?>
        </p>
        <?php
    }
    // SECTION 5 : HERO_ACTION ============================================
    public static function display_section_hero_action(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage desc call-to-action présent dans la section", "MyPortfolio"); ?>
        </p>
        <?php
    }

    
    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : HERO_MANAGEMENT ========================================
    public static function handle_hero_upload(){
        if(!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        //check if user had uploaded a file and clicked save changes button
        if(!empty($_FILES['bg_hero']['tmp_name'])){
            $url = wp_handle_upload($_FILES['bg_hero'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // no upload. Old file url is the new value.
        return get_option('bg_hero');
    }
    
    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : HERO_MANAGEMENT ========================================
    public static function field_hero_hidden(){
        $hero_hidden_section = get_option('hero_hidden_section');
        ?>
        <input type="checkbox" id="hero_hidden_section" name="hero_hidden_section" value="1" <?php checked(1, $hero_hidden_section, true); ?> />
        <label for=""><?php _e('Masquer la section home du thème', "MyPortfolio"); ?></label>
        <?php
    }
    public static function field_hero_image(){
        $add_bg_hero = get_option('add_bg_hero');
        $bg_hero = get_option('bg_hero');
        ?>
        <div>
            <input type="checkbox" id="add_bg_hero" name="add_bg_hero" value="1" <?php checked(1, $add_bg_hero, true); ?> />
            <label for=""><?php _e('Ajouter une image comme arrière plan', "MyPortfolio"); ?></label>
        </div>
        <div class="seen space-y-2">
            <p><?php _e("Aperçu :", "MyPortfolio"); ?></p>
            <img src="<?php echo get_option('bg_hero'); ?>"
                 alt="background home section" class="img-hero"
            />
        </div>
        <div class="bg-input-file">
            <input type="file" id="bg_hero" name="bg_hero" value="<?php echo get_option('bg_hero') ?>" />
        </div>

        <?php
    }

    // SECTION 2 : HERO_SALUTATION ========================================
    public static function field_hero_greeting(){
        $choose_format = get_option('choose_format');
        // format 1
        $hero_greeting_fr = esc_attr(get_option('hero_greeting_fr'));
        $hero_greeting_en = esc_attr(get_option('hero_greeting_en'));
        $hero_greeting_it = esc_attr(get_option('hero_greeting_it'));
        // format 2
        $hero_msg_oneline_fr = esc_attr(get_option('hero_msg_oneline_fr'));
        $hero_msg_oneline_en = esc_attr(get_option('hero_msg_oneline_en'));
        $hero_msg_oneline_it = esc_attr(get_option('hero_msg_oneline_it'));
        $hero_msg_twoline_fr = esc_attr(get_option('hero_msg_twoline_fr'));
        $hero_msg_twoline_en = esc_attr(get_option('hero_msg_twoline_en'));
        $hero_msg_twoline_it = esc_attr(get_option('hero_msg_twoline_it'));
        ?>
        <div class="box-greeting">
            <p>
                <input type="radio" name="choose_format" value="1" <?php checked(1, $choose_format, true); ?> />
                <label for=""><?php _e('Salutation en 1 ligne', "MyPortfolio"); ?></label>
            </p>
            <div class="grid-cols-3">
                <div class="grid-box">
                    <p class="box-title"><?php _e('Francais', "MyPortfolio"); ?></p>
                    <input type="text"
                           id="hero_greeting_fr"
                           name="hero_greeting_fr"
                           value="<?php echo $hero_greeting_fr ?>"
                           placeholder="<?php _e('Salutation en français', 'MyPortfolio'); ?>"
                    />
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                    <input type="text"
                           id="hero_greeting_en"
                           name="hero_greeting_en"
                           value="<?php echo $hero_greeting_en ?>"
                           placeholder="<?php _e('Salutation en anglais', 'MyPortfolio'); ?>"
                    />
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                    <input type="text"
                           id="hero_greeting_it"
                           name="hero_greeting_it"
                           value="<?php echo $hero_greeting_it ?>"
                           placeholder="<?php _e('Salutation en italien', 'MyPortfolio'); ?>"
                    />
                </div>
            </div>
        </div>
        <div class="box-greeting separation">
            <p>
                <input type="radio" name="choose_format" value="2" <?php checked(2, $choose_format, true); ?> />
                <label for=""><?php _e('Salutation en 2 lignes', "MyPortfolio"); ?></label>
            </p>
            <div class="grid-cols-3">
                <div class="grid-box">
                    <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                    <div>
                        <p><?php _e("Ligne 1", "MyPortfolio") ?></p>
                        <input type="text"
                               id="hero_msg_oneline_fr"
                               name="hero_msg_oneline_fr"
                               value="<?php echo $hero_msg_oneline_fr ?>"
                               placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                        />
                    </div>
                    <div class="space-y-4">
                        <p><?php _e("Ligne 2", "MyPortfolio") ?></p>
                        <input type="text"
                               id="hero_msg_twoline_fr"
                               name="hero_msg_twoline_fr"
                               value="<?php echo $hero_msg_twoline_fr ?>"
                               placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                        />
                    </div>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                    <div>
                        <p><?php _e("Ligne 1", "MyPortfolio") ?></p>
                        <input type="text"
                               id="hero_msg_oneline_en"
                               name="hero_msg_oneline_en"
                               value="<?php echo $hero_msg_oneline_en ?>"
                               placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                        />
                    </div>
                    <div class="space-y-4">
                        <p><?php _e("Ligne 2", "MyPortfolio") ?></p>
                        <input type="text"
                               id="hero_msg_twoline_en"
                               name="hero_msg_twoline_en"
                               value="<?php echo $hero_msg_twoline_en ?>"
                               placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                        />
                    </div>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                    <div>
                        <p><?php _e("Ligne 1", "MyPortfolio") ?></p>
                        <input type="text"
                           id="hero_msg_oneline_it"
                           name="hero_msg_oneline_it"
                           value="<?php echo $hero_msg_oneline_it ?>"
                           placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                    />
                    </div>
                    <div class="space-y-4">
                        <p><?php _e("Ligne 2", "MyPortfolio") ?></p>
                        <input type="text"
                           id="hero_msg_twoline_it"
                           name="hero_msg_twoline_it"
                           value="<?php echo $hero_msg_twoline_it ?>"
                           placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                    />
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public static function field_hero_element(){
        $hero_show_lastname = get_option('hero_show_lastname');
        $hero_show_firsrname = get_option('hero_show_firsrname');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyPortfolio") ?></p>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="hero_show_lastname" name="hero_show_lastname" value="1" <?php checked(1, $hero_show_lastname, true); ?>  />
                <label for=""><?php _e("Nom", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="hero_show_firsrname" name="hero_show_firsrname" value="1" <?php checked(1, $hero_show_firsrname, true); ?>  />
                <label for=""><?php _e("Prénom", "MyPortfolio"); ?></label>
            </li>
        </ul>
        <?php
    }

    // SECTION 3 : HERO_JOB ===============================================
    public static function field_hero_job_hidden(){
        $hero_hidden_job = get_option('hero_hidden_job');
        ?>
        <input type="checkbox" id="hero_hidden_job" name="hero_hidden_job" value="1" <?php checked(1, $hero_hidden_job, true); ?> />
        <label for=""><?php _e("Masquer le poste visé", "MyPortfolio"); ?></label>
        <?php
    }
    public static function field_hero_job_message(){
        $hero_msg_job_fr = esc_attr(get_option('hero_msg_job_fr'));
        $hero_msg_job_en = esc_attr(get_option('hero_msg_job_en'));
        $hero_msg_job_it = esc_attr(get_option('hero_msg_job_it'));
        ?>
        <p class="description"><?php _e("Uniquement si la section est visible", "MyPortfolio") ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="hero_msg_job_fr"
                       name="hero_msg_job_fr"
                       value="<?php echo $hero_msg_job_fr ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
                <p class="text-right"><?php echo get_option("job_title_fr"); ?></p>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="hero_msg_job_en"
                       name="hero_msg_job_en"
                       value="<?php echo $hero_msg_job_en ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
                <p class="text-right"><?php echo get_option("job_title_en"); ?></p>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="hero_msg_job_it"
                       name="hero_msg_job_it"
                       value="<?php echo $hero_msg_job_it ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
                <p class="text-right"><?php echo get_option("job_title_it"); ?></p>
            </div>
        </div>
        <?php
    }

    // SECTION 4 : HERO_ABOUT =============================================
    public static function field_hero_job_about(){
        $hero_show_about_fr = get_option('hero_show_about_fr');
        $hero_show_about_en = get_option('hero_show_about_en');
        $hero_show_about_it = get_option('hero_show_about_it');
        ?>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <p>
                    <input type="checkbox" id="hero_show_about_fr" name="hero_show_about_fr" value="1" <?php checked(1, $hero_show_about_fr, true); ?> />
                    <label for=""><?php _e("Ajouter la petite intro", 'MyPortfolio'); ?></label>
                </p>
                <blockquote><?php echo get_option("short_aboutme_fr"); ?></blockquote>
                <div class="mt-1 text-right">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyPortfolio'); ?></a>
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <p>
                    <input type="checkbox" id="hero_show_about_en" name="hero_show_about_en" value="1" <?php checked(1, $hero_show_about_en, true); ?> />
                    <label for=""><?php _e("Ajouter la petite intro", 'MyPortfolio'); ?></label>
                </p>
                <blockquote><?php echo get_option("short_aboutme_en"); ?></blockquote>
                <div class="mt-1 text-right">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyPortfolio'); ?></a>
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <p>
                    <input type="checkbox" id="hero_show_about_it" name="hero_show_about_it" value="1" <?php checked(1, $hero_show_about_it, true); ?> />
                    <label for=""><?php _e("Ajouter la petite intro", 'MyPortfolio'); ?></label>
                </p>
                <blockquote><?php echo get_option("short_aboutme_it"); ?></blockquote>
                <div class="mt-1 text-right">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyPortfolio'); ?></a>
                </div>
            </div>
        </div>
        <?php
    }

    // SECTION 5 : HERO_ACTION ============================================
    public static function field_hero_btn_about(){
        $hero_btn_about = get_option('hero_btn_about');
        $hero_icon_about = get_option('hero_icon_about');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="hero_btn_about" name="hero_btn_about" value="1" <?php checked(1, $hero_btn_about, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="hero_icon_about" name="hero_icon_about" value="1" <?php checked(1, $hero_icon_about, true); ?> />
                <label for=""><?php _e("Afficher l'îcone", "MyPortfolio"); ?><i class="icons flaticon-user"></i></label>
            </li>
        </ul>
        <?php
    }
    public static function field_hero_btn_download(){
        $hero_btn_download = get_option('hero_btn_download');
        $hero_icon_download = get_option('hero_icon_download');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="hero_btn_download" name="hero_btn_download" value="1" <?php checked(1, $hero_btn_download, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="hero_icon_download" name="hero_icon_download" value="1" <?php checked(1, $hero_icon_download, true); ?> />
                <label for=""><?php _e("Afficher l'îcone", "MyPortfolio"); ?><i class="icons flaticon-download"></i></label>
            </li>
        </ul>
        <?php
    }
    public static function field_hero_btn_contact(){
        $hero_btn_contact = get_option('hero_btn_contact');
        $hero_icon_contact = get_option('hero_icon_contact');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="hero_btn_contact" name="hero_btn_contact" value="1" <?php checked(1, $hero_btn_contact, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="hero_icon_contact" name="hero_icon_contact" value="1" <?php checked(1, $hero_icon_contact, true); ?> />
                <label for=""><?php _e("Afficher l'îcone", "MyPortfolio"); ?><i class="icons flaticon-email"></i></label>
            </li>
        </ul>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_home')){
    mycustome_home::register();
}