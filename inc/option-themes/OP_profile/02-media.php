<?php
/**
 * Name file: 02-media
 * Description: this file allows to manage the picture profile [Upload of media]
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


class myprofil_medias{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP   = 'myprofil_medias';
    const NONCE        = '_myprofil_medias';

    //definir les sections de la page d'option
    const SECTION_MEDIA  = 'section_media';

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
            __('Mes médias', 'MyPortfolio'),            // page_title
            __('Mes médias', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Mes médias', 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les différents média de votre portfolio', 'MyPortfolio') ?>
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
         * SECTION 1 : SECTION_MEDIA ===================================
         *             1. Créer la section
         *             2. Ajouter les éléments du formulaire
         *             3. Sauvegarder les champs
         *
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_MEDIA,                 // SLUG_SECTION
            __('Mes photos', 'MyPortfolio'),                // TITLE
            [self::class, 'display_section_media'],  // CALLBACK
            self::SUB_GROUP                        // SLUG_PAGE
        ); // Section 2

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'add_media',                          // SLUG_FIELD
            __('Ajouter les medias', 'MyPortfolio'),         // LABEL
            [self::class,'field_add_media'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_MEDIA               // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'myprofil', [self::class, 'handle_profil_upload']);
        register_setting(self::SUB_GROUP, 'myavatar', [self::class, 'handle_avatar_upload']);
        register_setting(self::SUB_GROUP, 'mylogo', [self::class, 'handle_logo_upload']);
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_MEDIA ============================================
    public static function display_section_media(){
        ?>
        <p class="section-description">
            <?php _e('Ajouter les différentes photo de votre Portfolio', 'MyPortfolio') ?>
        </p>
        <?php
    }
   
    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_MEDIA ============================================
    public static function handle_profil_upload(){
        if(!function_exists('wp_handle_upload'))
        {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        //check if user had uploaded a file and clicked save changes button
        if(!empty($_FILES['myprofil']['tmp_name'])){
            $url = wp_handle_upload($_FILES['myprofil'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // no upload. Old file url is the new value.
        return get_option('myprofil');

    }

    public static function handle_avatar_upload(){
        if(!function_exists('wp_handle_upload'))
        {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        //check if user had uploaded a file and clicked save changes button
        if(!empty($_FILES['myavatar']['tmp_name'])){
            $url = wp_handle_upload($_FILES['myavatar'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // no upload. Old file url is the new value.
        return get_option('myavatar');

    }

    public static function handle_logo_upload(){
        if(!function_exists('wp_handle_upload'))
        {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        //check if user had uploaded a file and clicked save changes button
        if(!empty($_FILES['mylogo']['tmp_name'])){
            $url = wp_handle_upload($_FILES['mylogo'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // no upload. Old file url is the new value.
        return get_option('mylogo');

    }

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_MEDIA ============================================
    public static function field_add_media(){
        $myprofil = esc_attr(get_option('myprofil'));
        $myavatar = esc_attr(get_option('myavatar'));
        $mylogo = esc_attr(get_option('mylogo'));
        ?>
        <div class="grid-cols-3">
            <div class="item-picture-cv">
                <p class="picture-cv-title"><?php _e("Ma photo de profile", "MyPortfolio") ?></p>
                <div class="picture-cv-preview">
                    <p><?php _e("aperçu :", "MyPortfolio" )?></p>
                    <img src="<?php echo get_option("myprofil") ?>"
                         alt="<?php _e('Ma photo de profile', 'MyPortfolio') ?>"
                         class="mini-thumbnail"
                    />
                </div>
                <div class="picture-cv-file">
                    <input type="file"
                           id="myprofil"
                           name="myprofil"
                           value="<?php echo get_option("myprofil") ?>"
                    />
                </div>
            </div><!--./item-picture-cv-->
            <div class="item-picture-cv">
                <p class="picture-cv-title"><?php _e("Ma photo d'avatar", "MyPortfolio") ?></p>
                <div class="picture-cv-preview">
                    <p><?php _e("aperçu :", "MyPortfolio" )?></p>
                    <img src="<?php echo get_option("myavatar") ?>"
                         alt="<?php _e('Ma photo d\'avatar', 'MyPortfolio') ?>"
                         class="mini-thumbnail"
                    />
                </div>
                <div class="picture-cv-file">
                    <input type="file"
                           id="myavatar"
                           name="myavatar"
                           value="<?php echo get_option("myavatar") ?>"
                    />
                </div>
            </div><!--./item-picture-cv-->
            <div class="item-picture-cv">
                <p class="picture-cv-title"><?php _e("Mon logo", "MyPortfolio") ?></p>
                <div class="picture-cv-preview">
                    <p><?php _e("aperçu :", "MyPortfolio" )?></p>
                    <img src="<?php echo get_option("mylogo") ?>"
                         alt="<?php _e('Mon logo', 'MyPortfolio') ?>"
                         class="mini-thumbnail"
                    />
                </div>
                <div class="picture-cv-file">
                    <input type="file"
                           id="mylogo"
                           name="mylogo"
                           value="<?php echo get_option("mylogo") ?>"
                    />
                </div>
            </div><!--./item-picture-cv-->
        </div><!--./grid-->

        <?php
    }


    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myprofil_medias')){
    myprofil_medias::register();
}