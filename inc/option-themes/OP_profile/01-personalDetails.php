<?php
/**
 * Name file: 01-pesonalDetail
 * Description: this file allows to manage the detail personal
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

class myportfolio_myprofil{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-smiley';
    const GROUP      = 'myprofil';
    const NONCE      = '_myprofil';

    //definir les sections de la page d'option
    const SECTION_DETAIL = 'section_detail';
    const SECTION_LOCATION = 'section_location';
    const SECTION_POST = 'section_post';


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
        add_menu_page(
            __('Mon profile', 'MyPortfolio'),       // TITLE_PAGE
            __('Mon profile', 'MyPortfolio'),        // TITLE_MENU
            self::PERMITION,           // CAPABILITY
            self::GROUP,              // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,             // icon
            2                           // POSITION
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Mon profile', 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer vos inforation personnel', 'MyPortfolio') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
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
         * SECTION 1 : SECTION_DETAIL =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_DETAIL,                 // SLUG_SECTION
            __('Détails personnels', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_detail'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        );
        
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'myfullname',                            // SLUG_FIELD
            __('Nom complet', 'MyPortfolio'),            // LABEL
            [self::class,'field_myfullname'],        // CALLBACK
            self::GROUP ,                             // SLUG_PAGE
            self::SECTION_DETAIL                      // SLUG_SECTION
        );
        add_settings_field(
            'mybirthday',                           // SLUG_FIELD
            __('Date de naissance', 'MyPortfolio'),            // LABEL
            [self::class,'field_mybirthday'],       // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::GROUP, 'mylastname');
        register_setting(self::GROUP, 'myfirstname');
        register_setting(self::GROUP, 'mybirthday');

        /**
         * 
         * SECTION 2 : SECTION_LOCATION ===================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_LOCATION,                 // SLUG_SECTION
            __('Mes coordonnés', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_location'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'mylocation',                              // SLUG_FIELD
            __('Localité', 'MyPortfolio'),               // LABEL
            [self::class,'field_mylocation'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );
        add_settings_field(
            'myemail',                              // SLUG_FIELD
            __('Email', 'MyPortfolio'),               // LABEL
            [self::class,'field_myemail'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );
        add_settings_field(
            'myphone',                              // SLUG_FIELD
            __('Téléphone', 'MyPortfolio'),        // LABEL
            [self::class,'field_myphone'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );
        
        // 3. Sauvegarder les champs
        register_setting(self::GROUP, 'mylocation');
        register_setting(self::GROUP, 'mycountry');
        register_setting(self::GROUP, 'myemail');
        register_setting(self::GROUP, 'myphone');


        /**
         * SECTION 3 : SECTION_POST =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_POST,                 // SLUG_SECTION
            __('Poste', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_post'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'job_title',                            // SLUG_FIELD
            __('Titre du job', 'MyPortfolio'),          // LABEL
            [self::class,'field_job_title'],        // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_POST                    // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::GROUP, 'job_title_fr');
        register_setting(self::GROUP, 'job_title_en');
        register_setting(self::GROUP, 'job_title_it');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_DETAIL =====================================
    public static function display_section_detail(){
        ?>
        <p class="section-description">
            <?php _e('Section dédiée aux informations personnels', 'MyPortfolio') ?>
        </p>
        <?php
    }
    
    // SECTION 2 : SECTION_LOCATION ===================================
    public static function display_section_location(){
        ?>
        <p class="section-description">
            <?php _e('Section dédiée aux informations de contact', 'MyPortfolio') ?>
        </p>
        <?php
    }
    
    // SECTION 3 : SECTION_POST =======================================
    public static function display_section_post(){
        ?>
        <p class="section-description">
            <?php _e('Section dédiée à la traduction du post', 'MyPortfolio') ?>
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
    // SECTION 1 : SECTION_DETAIL =====================================
    public static function field_myfullname(){
        $mylastname = esc_attr(get_option('mylastname'));
        $myfirstname = esc_attr(get_option('myfirstname'));
        ?>
        <div>
            <input type="text"
                   id="mylastname"
                   name="mylastname"
                   value="<?php echo $mylastname ?>"
                   class="regular-text"
                   placeholder="<?php _e('Nom', 'MyPortfolio'); ?>"
            />
            <input type="text"
                   id="myfirstname"
                   name="myfirstname"
                   value="<?php echo $myfirstname ?>"
                   class="regular-text"
                   placeholder="<?php _e('Prénom', 'MyPortfolio'); ?>"
            />
        </div>
        <?php
    }
    public static function field_mybirthday(){
        $mybirthday = esc_attr(get_option('mybirthday'));
        ?>
        <input type="date"
               id="mybirthday"
               name="mybirthday"
               value="<?php echo $mybirthday ?>"
        />
        <?php
    }

    // SECTION 2 : SECTION_LOCATION ===================================
    public static function field_mylocation(){
        $mylocation = esc_attr(get_option('mylocation'));
        $mycountry = get_option('mycountry');
        ?>
                <input type="text"
                       name="mylocation"
                       id="mylocation"
                       value="<?php echo $mylocation ?>"
                       class="regular-text"
                       placeholder="<?php _e('La localité', 'MyPortfolio'); ?>"
                />

                <label for="">
                    <input type="checkbox" id="mycountry" name="mycountry" value="1" <?php checked(1, $mycountry, true); ?> />
                    <?php _e("Belgique", "MyPorfolio") ?>
                </label>
        <?php
    }
    public static function field_myemail(){
        $myemail = esc_attr(get_option('myemail'));
        ?>
        <input type="email"
               id="myemail"
               name="myemail"
               value="<?php echo $myemail ?>"
               class="regular-text"
               placeholder="sophie@example.com"
        />
        <?php
    }
    public static function field_myphone(){
        $myphone = esc_attr(get_option('myphone'));
        ?>
        <input type="tel"
               id="myphone"
               name="myphone"
               value="<?php echo $myphone ?>"
               class="regular-text"
               placeholder="0000000000"
        />
        <?php
    }
    
    // SECTION 3 : SECTION_POST =======================================
    public static function field_job_title(){
        $job_title_fr = esc_attr(get_option('job_title_fr'));
        $job_title_en = esc_attr(get_option('job_title_en'));
        $job_title_it = esc_attr(get_option('job_title_it'));
        ?>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyPorfolio"); ?></p>
                <div>
                    <input type="text"
                           id="job_title_fr"
                           name="job_title_fr"
                           value="<?php echo $job_title_fr ?>"
                           class="regular-text"
                           placeholder="<?php _e("Titre du poste en français", "MyPortfolio"); ?>"
                    />
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyPorfolio"); ?></p>
                <div>
                    <input type="text"
                           id="job_title_en"
                           name="job_title_en"
                           value="<?php echo $job_title_en ?>"
                           class="regular-text"
                           placeholder="<?php _e("Titre du poste en anglais", "MyPortfolio"); ?>"
                    />
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyPorfolio"); ?></p>
                <div>
                    <input type="text"
                           id="job_title_it"
                           name="job_title_it"
                           value="<?php echo $job_title_it ?>"
                           class="regular-text"
                           placeholder="<?php _e("Titre du poste en italien", "MyPortfolio"); ?>"
                    />
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myportfolio_myprofil')){
    myportfolio_myprofil::register();
}