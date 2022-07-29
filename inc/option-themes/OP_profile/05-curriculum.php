<?php
/**
 * Name file: 05-curriculum
 * Description: this file allows to manage resumes import
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

class myprofil_curriculum{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 4
    const PERMITION   = 'manage_options';
    const SUB_GROUP   = 'myprofil_curriculum';
    const NONCE       = '_myprofil_curriculum';

    //definir les sections de la page d'option
    const SECTION_FR = "section_fr";
    const SECTION_EN = "section_en";
    const SECTION_IT = "section_it";

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
            __('Curriculum', 'MyPortfolio'),               // page_title
            __('Curriculum', 'MyPortfolio'),               // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Curriculum Vitae', 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e("Sur cette page, vous pouvez gérer l'import de votre CV", 'MyPortfolio') ?>
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
         * SECTION 1 : SECTION_FR =========================================
         *   1. Créer la section
         *   2. Ajouter les éléments du formulaire
         *   3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_FR,                   // SLUG_SECTION
            __('Section en français', 'MyPortfolio'),      // TITLE
            [self::class, 'display_section_fr'],   // CALLBACK
            self:: SUB_GROUP                // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'curriculum_fr',                     // SLUG_FIELD
            __('Importer mon CV', 'MyPortfolio'),               // LABEL
            [self::class,'field_curriculum_fr'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_FR                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'curriculum_fr', [self::class, 'handle_cvfr_upload']);

        /**
         * SECTION 2 : SECTION_EN =========================================
         *   1. Créer la section
         *   2. Ajouter les éléments du formulaire
         *   3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_EN,                   // SLUG_SECTION
            __('Section en anglais', 'MyPortfolio'),      // TITLE
            [self::class, 'display_section_en'],   // CALLBACK
            self:: SUB_GROUP                // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'curriculum_en',                     // SLUG_FIELD
            __('Importer mon CV', 'MyPortfolio'),               // LABEL
            [self::class,'field_curriculum_en'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EN                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'curriculum_en', [self::class, 'handle_cven_upload']);

        /**
         * SECTION 3 : SECTION_IT =========================================
         *   1. Créer la section
         *   2. Ajouter les éléments du formulaire
         *   3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_IT,                   // SLUG_SECTION
            __('Section en italien', 'MyPortfolio'),      // TITLE
            [self::class, 'display_section_it'],   // CALLBACK
            self:: SUB_GROUP                // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'curriculum_it',                     // SLUG_FIELD
            __('Importer mon CV', 'MyPortfolio'),               // LABEL
            [self::class,'field_curriculum_it'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_IT                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'curriculum_it', [self::class, 'handle_cvit_upload']);
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function display_section_fr(){
        ?>
        <p class="section-description">
            <?php _e("Gestion de la section en français", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 2 : SECTION_EN =========================================
    public static function display_section_en(){
        ?>
        <p class="section-description">
            <?php _e("Gestion de la section en anglais", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 3 : SECTION_IT =========================================
    public static function display_section_it(){
        ?>
        <p class="section-description">
            <?php _e("Gestion de la section en italien", "MyPortfolio") ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function handle_cvfr_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['curriculum_fr']['tmp_name'])){
            $url = wp_handle_upload($_FILES['curriculum_fr'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('curriculum_fr');
    }
    // SECTION 2 : SECTION_EN =========================================
    public static function handle_cven_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['curriculum_en']['tmp_name'])){
            $url = wp_handle_upload($_FILES['curriculum_en'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('curriculum_en');
    }
    // SECTION 3 : SECTION_IT =========================================
    public static function handle_cvit_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['curriculum_it']['tmp_name'])){
            $url = wp_handle_upload($_FILES['curriculum_it'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('curriculum_it');
    }

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function field_curriculum_fr(){
        $curriculum_fr = esc_attr(get_option('curriculum_fr'));
        ?>
        <div class="grid-cols-2">
            <div class="input-file">
                <input type="file" id="curriculum_fr" name="curriculum_fr" value="<?php echo $curriculum_fr ?>" />
            </div>
            <div class="display-pdf">
                <embed src="<?php echo $curriculum_fr ?>" type="application/pdf" class="w-full" />
            </div>
        </div>
        <?php
    }
    // SECTION 2 : SECTION_EN =========================================
    public static function field_curriculum_en(){
        $curriculum_en = esc_attr(get_option('curriculum_en'));
        ?>
        <div class="grid-cols-2">
            <div class="input-file">
                <input type="file" id="curriculum_en" name="curriculum_en" value="<?php echo $curriculum_en ?>" />
            </div>
            <div class="display-pdf">
                <embed src="<?php echo $curriculum_en ?>" type="application/pdf" class="w-full" />
            </div>
        </div>
        <?php
    }
    // SECTION 3 : SECTION_IT =========================================
    public static function field_curriculum_it(){
        $curriculum_it = esc_attr(get_option('curriculum_it'));
        ?>
        <div class="grid-cols-2">
            <div class="input-file">
                <input type="file" id="curriculum_it" name="curriculum_it" value="<?php echo $curriculum_it ?>" />
            </div>
            <div class="display-pdf">
                <embed src="<?php echo $curriculum_it ?>" type="application/pdf" class="w-full" />
            </div>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myprofil_curriculum')){
    myprofil_curriculum::register();
}