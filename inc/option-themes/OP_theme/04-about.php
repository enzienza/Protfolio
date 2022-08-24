<?php
/**
 * Name file: 04-about
 * Description: this file allows to manage display of the about section
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

class mycustome_about{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_about';
    const NONCE        = '_mycustome_about';

    //definir les sections de la page d'option
    const ABOUT_MANAGEMENT = "about_management";
    const ABOUT_INFO        = "about_info";
    const ABOUT_ACTION      = "about_action";



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
            __('About', 'MyPortfolio'),            // page_title
            __('About', 'MyPortfolio'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser l'about", 'MyPortfolio') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section about du site', 'MyPortfolio') ?>
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
         * SECTION 1 : ABOUT_MANAGEMENT ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::ABOUT_MANAGEMENT,                 // SLUG_SECTION
            __('About', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_about_management'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'about_hidden',                        // SLUG_FIELD
            __('Cacher la section', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_hidden'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'about_title',                        // SLUG_FIELD
            __('Titre section', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_title'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_MANAGEMENT                // SLUG_SECTION
        );
        add_settings_field(
            'about_design',                        // SLUG_FIELD
            __('Définir le design', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_design'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_MANAGEMENT                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'about_hidden_section');
       // title
        register_setting(self::SUB_GROUP, 'about_title_fr');
        register_setting(self::SUB_GROUP, 'about_title_en');
        register_setting(self::SUB_GROUP, 'about_title_it');
        // choose design
        register_setting(self::SUB_GROUP, 'about_left_design');
        register_setting(self::SUB_GROUP, 'about_right_design');

        /**
         * SECTION 2 : ABOUT_INFO ===============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::ABOUT_INFO,                 // SLUG_SECTION
            __('Gérer les éléments', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_about_info'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'about_personal_details',                        // SLUG_FIELD
            __('Details personnel', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_personal_details'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_INFO                // SLUG_SECTION
        );
        add_settings_field(
            'about_msg',                        // SLUG_FIELD
            __('Qui suis-je', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_msg'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_INFO                // SLUG_SECTION
        );
        add_settings_field(
            'about_picture',                        // SLUG_FIELD
            __('Photo', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_picture'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_INFO                // SLUG_SECTION
        );
        add_settings_field(
            'about_complementary',                        // SLUG_FIELD
            __('Info supplémentaire', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_complementary'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_INFO                // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        // Personal details
        register_setting(self::SUB_GROUP, 'about_show_fullname');
        register_setting(self::SUB_GROUP, 'about_show_age');
        register_setting(self::SUB_GROUP, 'about_show_country');
        register_setting(self::SUB_GROUP, 'about_show_job');
        // Choose message
        register_setting(self::SUB_GROUP, 'about_message');
        // Choose picture
        register_setting(self::SUB_GROUP, 'about_picture');
        // Info complementary
        // general
        register_setting(self::SUB_GROUP, 'about_years_experience');
        register_setting(self::SUB_GROUP, 'years_experience');
        register_setting(self::SUB_GROUP, 'about_formations');
        register_setting(self::SUB_GROUP, 'numb_formation');
        register_setting(self::SUB_GROUP, 'about_languanges');
        register_setting(self::SUB_GROUP, 'numb_languanges');
        register_setting(self::SUB_GROUP, 'about_repository');
        register_setting(self::SUB_GROUP, 'numb_repository');
        // project
        register_setting(self::SUB_GROUP, 'about_all_project');
        register_setting(self::SUB_GROUP, 'about_web_project');
        register_setting(self::SUB_GROUP, 'about_proto_project');
        register_setting(self::SUB_GROUP, 'about_graph_project');
        // client
        register_setting(self::SUB_GROUP, 'about_real_client');
        register_setting(self::SUB_GROUP, 'about_satisfied_client');


        /**
         * SECTION 3 : ABOUT_ACTION =============================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::ABOUT_ACTION,                 // SLUG_SECTION
            __('Call to action', 'MyPortfolio'),         // TITLE
            [self::class, 'display_section_about_action'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'about_btn_download',                        // SLUG_FIELD
            __('Download CV', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_btn_download'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_ACTION                // SLUG_SECTION
        );
        add_settings_field(
            'about_btn_contact',                        // SLUG_FIELD
            __('Contact', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_btn_contact'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_ACTION                // SLUG_SECTION
        );
        add_settings_field(
            'about_btn_skill',                        // SLUG_FIELD
            __('Skill', 'MyPortfolio'),  // LABEL
            [self::class,'field_about_btn_skill'],        // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::ABOUT_ACTION                // SLUG_SECTION
        );
        
        // 3. Sauvegarder les champs
        // Download
        register_setting(self::SUB_GROUP, 'about_btn_download');
        register_setting(self::SUB_GROUP, 'about_icon_download');
        // Contact
        register_setting(self::SUB_GROUP, 'about_btn_contact');
        register_setting(self::SUB_GROUP, 'about_icon_contact');
        // Skill
        register_setting(self::SUB_GROUP, 'about_btn_skill');
        register_setting(self::SUB_GROUP, 'about_icon_skill');


    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : ABOUT_MANAGEMENT ========================================
    public static function display_section_about_management(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 2 : ABOUT_INFO ===============================================
    public static function display_section_about_info(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage des informations", "MyPortfolio") ?>
        </p>
        <?php
    }
    // SECTION 3 : ABOUT_ACTION =============================================
    public static function display_section_about_action(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage desc call-to-action présent dans la section", "MyPortfolio") ?>
        </p>
        <?php
    }


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : ABOUT_MANAGEMENT ========================================
    // SECTION 2 : ABOUT_INFO ===============================================
    // SECTION 3 : ABOUT_ACTION =============================================

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : ABOUT_MANAGEMENT ========================================
    public static function field_about_hidden(){
        $about_hidden_section = get_option('about_hidden_section');
        ?>
        <input type="checkbox" id="about_hidden_section" name="about_hidden_section" value="1" <?php checked(1, $about_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section about du thème", "MyPortfolio"); ?></label>
        <?php
    }
    public static function field_about_title(){
        $about_title_fr = esc_attr(get_option('about_title_fr'));
        $about_title_en = esc_attr(get_option('about_title_en'));
        $about_title_it = esc_attr(get_option('about_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyPortfolio"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                <input type="text"
                       id="about_title_fr"
                       name="about_title_fr"
                       value="<?php echo $about_title_fr ?>"
                       placeholder="<?php _e('Texte en français', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                <input type="text"
                       id="about_title_en"
                       name="about_title_en"
                       value="<?php echo $about_title_en ?>"
                       placeholder="<?php _e('Texte en anglais', 'MyPortfolio'); ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                <input type="text"
                       id="about_title_it"
                       name="about_title_it"
                       value="<?php echo $about_title_it ?>"
                       placeholder="<?php _e('Texte en italien', 'MyPortfolio'); ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_about_design(){
        $about_left_design = get_option('about_left_design');
        $about_right_design = get_option('about_right_design');
        ?>
        <p class="description"><?php _e("Choisir les éléments à afficher", "MyPortfolio"); ?></p>
        <div class="grid-cols-2">
            <div class="grid-box">
                <p class="box-title"><?php _e("Partie de gauche", "MyPortfolio"); ?></p>
                <p>
                    <input type="radio" name="about_left_design" value="1" <?php checked(1, $about_left_design, true); ?>  />
                    <label for=""><?php _e('Afficher "Qui suis-je"', "MyPortfolio"); ?></label>
                </p>
                <p>
                    <input type="radio" name="about_left_design" value="2" <?php checked(2, $about_left_design, true); ?>  />
                    <label for=""><?php _e('Afficher "Détails perso"', "MyPortfolio"); ?></label>
                </p>
                <p>
                    <input type="radio" name="about_left_design" value="3" <?php checked(3, $about_left_design, true); ?>  />
                    <label for=""><?php _e('Afficher les deux (Qui suis-je & Détails perso)', "MyPortfolio"); ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Partie de droite", "MyPortfolio"); ?></p>
                <p>
                    <input type="radio" name="about_right_design" value="1" <?php checked(1, $about_right_design, true); ?>  />
                    <label for=""><?php _e('Afficher une photo', "MyPortfolio"); ?></label>
                </p>
                <p>
                    <input type="radio" name="about_right_design" value="2" <?php checked(2, $about_right_design, true); ?>  />
                    <label for=""><?php _e('Afficher le "Counter"', "MyPortfolio"); ?></label>
                </p>
                <p>
                    <input type="radio" name="about_right_design" value="3" <?php checked(3, $about_right_design, true); ?>  />
                    <label for=""><?php _e('Afficher les deux (Photo & Counter)', "MyPortfolio"); ?></label>
                </p>
            </div>
        </div>
        <?php
    }

    // SECTION 2 : ABOUT_INFO ===============================================
    public static function field_about_personal_details(){
        $about_show_fullname = get_option('about_show_fullname');
        $about_show_age = get_option('about_show_age');
        $about_show_country = get_option('about_show_country');
        $about_show_job = get_option('about_show_job');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent | <span class='underline-700'>Important</span>Uniquement si <strong>détails perso</strong> est cocher", "MyPortfolio"); ?></p>
        <ul class="w-50 list-group">
            <li class="list-item">
                <input type="checkbox" id="about_show_fullname" name="about_show_fullname" value="1" <?php checked(1, $about_show_fullname, true); ?>  />
                <label for=""><?php _e("Nom complet", "MyPortfolio"); ?></label>
            </li>
            <li class="list-item">
                <input type="checkbox" id="about_show_age" name="about_show_age" value="1" <?php checked(1, $about_show_age, true); ?>  />
                <label for=""><?php _e("Âge", "MyPortfolio"); ?></label>
            </li>
            <li class="list-item">
                <input type="checkbox" id="about_show_country" name="about_show_country" value="1" <?php checked(1, $about_show_country, true); ?>  />
                <label for=""><?php _e("Ville", "MyPortfolio"); ?></label>
            </li>
            <li class="list-item">
                <input type="checkbox" id="about_show_job" name="about_show_job" value="1" <?php checked(1, $about_show_job, true); ?>  />
                <label for=""><?php _e("Métier visé", "MyPortfolio"); ?></label>
            </li>
        </ul>
        <?php
    }

    public static function field_about_msg(){
        $about_message = get_option('about_message');
        ?>
        <p class="description"><?php _e("Choisir quel message afficher | <span class='underline-700'>Important</span>Uniquement si <strong>Qui suis-je</strong> est cocher", "MyPortfolio"); ?></p>
        <div class="box-choose">
            <p>
                <input type="radio" name="about_message" value="1" <?php checked(1, $about_message, true) ?> />
                <label for=""><?php _e("Message court", "MyPortfolio"); ?></label>
            </p>
            <div class="grid-cols-3">
                <div class="grid-box">
                    <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("short_aboutme_fr"); ?></blockquote>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("short_aboutme_en"); ?></blockquote>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("short_aboutme_it"); ?></blockquote>
                </div>
            </div>
            <div class="mt-1 text-right">
                <a href="?page=myprofil_aboutme"><?php _e('Modifier les textes "Parler de sois"', 'MyPortfolio'); ?></a>
            </div>
        </div>
        <div class="box-choose">
            <p>
                <input type="radio" name="about_message" value="2" <?php checked(2, $about_message, true) ?> />
                <label for=""><?php _e("Message long", "MyPortfolio"); ?></label>
            </p>
            <div class="grid-cols-3">
                <div class="grid-box">
                    <p class="box-title"><?php _e('Français', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("talk_aboutme_fr"); ?></blockquote>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Anglais', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("talk_aboutme_en"); ?></blockquote>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e('Italien', "MyPortfolio"); ?></p>
                    <blockquote><?php echo get_option("talk_aboutme_it"); ?></blockquote>
                </div>
            </div>
            <div class="mt-1 text-right">
                <a href="?page=myprofil_aboutme"><?php _e('Modifier les textes "Parler de sois"', 'MyPortfolio'); ?></a>
            </div>
        </div>
        <?php
    }

    public static function field_about_picture(){
        $about_picture = get_option('about_picture');
        ?>
        <p class="description"><?php _e("Choisir la photo à afficher | <span class='underline-700'>Important</span>Uniquement si <strong>Photo</strong> est cocher", "MyPortfolio"); ?></p>
        <ul class="w-50 list-group">
            <li class="list-item">
                <input type="radio" name="about_picture" value="1" <?php checked(1, $about_picture, true); ?> />
                <label for=""><?php _e("Avatar", "MyPortfolio") ?></label>
            </li>
            <li class="list-item">
                <input type="radio" name="about_picture" value="2" <?php checked(2, $about_picture, true); ?> />
                <label for=""><?php _e("Profile", "MyPortfolio") ?></label>
            </li>
        </ul>
        <?php
    }

    public static function field_about_complementary(){
        // general
        $about_years_experience = get_option('about_years_experience');
        $years_experience = esc_attr(get_option('years_experience'));
        $about_formations = get_option('about_formations');
        $numb_formation = esc_attr(get_option('numb_formation'));
        $about_languanges = get_option('about_languanges');
        $numb_languanges = esc_attr(get_option('numb_languanges'));
        $about_repository = get_option('about_repository');
        $numb_repository = esc_attr(get_option('numb_repository'));
        // project
        $about_all_project = get_option('about_all_project');
        $about_web_project = get_option('about_web_project');
        $about_proto_project = get_option('about_proto_project');
        $about_graph_project = get_option('about_graph_project');
        // client
        $about_real_client = get_option('about_real_client');
        $about_satisfied_client = get_option('about_satisfied_client');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent | <span class='underline-700'>Important</span>Uniquement si <strong>Info Complémentaire</strong> est cocher", "MyPortfolio"); ?></p>

        <div class="grid-cols-3">
            <div class="general">
                <p class="box-title"><?php _e("Général", "MyPortfolio"); ?></p>
                <div>
                    <p class="general-item">
                        <span class="w-10">
                            <input type="checkbox" id="about_years_experience" name="about_years_experience" value="1" <?php checked(1, $about_years_experience, true); ?>  />
                            <label for=""><?php _e("Années d'expérience", "MyPortfolio"); ?></label>
                        </span>
                        <input type="date" class="small-input" id="years_experience" name="years_experience" min="2012-01-01" value="<?php echo $years_experience ?>" />
                    </p>
                    <p class="general-item">
                        <span class="w-10">
                            <input type="checkbox" id="about_formations" name="about_formations" value="1" <?php checked(1, $about_formations, true); ?>  />
                            <label for=""><?php _e("Formation réalisé", "MyPortfolio"); ?></label>
                        </span>
                        <input type="number" class="small-input" id="numb_formation" name="numb_formation" min="1" max="100" value="<?php echo $numb_formation ?>" />
                    </p>
                    <p class="general-item">
                        <span class="w-10">
                            <input type="checkbox" id="about_languanges" name="about_languanges" value="1" <?php checked(1, $about_languanges, true); ?>  />
                            <label for=""><?php _e("Langages maitrisé", "MyPortfolio"); ?></label>
                        </span>
                        <input type="number" class="small-input" id="numb_languanges" name="numb_languanges" min="1" max="100" value="<?php echo $numb_languanges ?>" />
                    </p>
                    <p class="general-item">
                        <span class="w-10">
                            <input type="checkbox" id="about_repository" name="about_repository" value="1" <?php checked(1, $about_repository, true); ?>  />
                            <label for=""><?php _e("Repositories GitHub", "MyPortfolio"); ?></label>
                        </span>
                        <input type="number" class="small-input" id="numb_repository" name="numb_repository" min="1" max="100" value="<?php echo $numb_repository ?>" />
                    </p>
                </div>
            </div>
            <div class="project">
                <p class="box-title"><?php _e("Projets", "MyPortfolio"); ?></p>
                <div>
                    <p class="project-item">
                        <input type="checkbox" id="about_all_project" name="about_all_project" value="1" <?php checked(1, $about_all_project, true); ?>  />
                        <label for=""><?php _e("Tous les projets", "MyPortfolio"); ?></label>
                    </p>
                    <p class="project-item">
                        <input type="checkbox" id="about_web_project" name="about_web_project" value="1" <?php checked(1, $about_web_project, true); ?>  />
                        <label for=""><?php _e("Projet web", "MyPortfolio"); ?></label>
                    </p>
                    <p class="project-item">
                        <input type="checkbox" id="about_proto_project" name="about_proto_project" value="1" <?php checked(1, $about_proto_project, true); ?>  />
                        <label for=""><?php _e("Projet prototypage", "MyPortfolio"); ?></label>
                    </p>
                    <p class="project-item">
                        <input type="checkbox" id="about_graph_project" name="about_graph_project" value="1" <?php checked(1, $about_graph_project, true); ?>  />
                        <label for=""><?php _e("Projet graphique", "MyPortfolio"); ?></label>
                    </p>
                </div>
            </div>
            <div class="clients">
                <p class="box-title"><?php _e("Clients", "MyPortfolio"); ?></p>
                <div>
                    <p class="client-item">
                        <input type="checkbox" id="about_real_client" name="about_real_client" value="1" <?php checked(1, $about_real_client, true); ?>  />
                        <label for=""><?php _e("Projet clients (réel)", "MyPortfolio"); ?></label>
                    </p>
                    <p class="client-item">
                        <input type="checkbox" id="about_satisfied_client" name="about_satisfied_client" value="1" <?php checked(1, $about_satisfied_client, true); ?>  />
                        <label for=""><?php _e("Clients satisfaits", "MyPortfolio"); ?></label>
                    </p>
                </div>
            </div>

        </div>

        <?php
    }

    // SECTION 3 : ABOUT_ACTION =============================================
    public static function field_about_btn_download(){
        $about_btn_download = get_option('about_btn_download');
        $about_icon_download = get_option('about_icon_download');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="about_btn_download" name="about_btn_download" value="1" <?php checked(1, $about_btn_download, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="about_icon_download" name="about_icon_download" value="1" <?php checked(1, $about_icon_download, true); ?> />
                <label for=""><?php _e("Afficher l'icône", "MyPortfolio"); ?><i class="icons flaticon-download"></i></label>
            </li>
        </ul>
        <?php
    }
    public static function field_about_btn_contact(){
        $about_btn_contact = get_option('about_btn_contact');
        $about_icon_contact = get_option('about_icon_contact');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="about_btn_contact" name="about_btn_contact" value="1" <?php checked(1, $about_btn_contact, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="about_icon_contact" name="about_icon_contact" value="1" <?php checked(1, $about_icon_contact, true); ?> />
                <label for=""><?php _e("Afficher l'icône", "MyPortfolio"); ?><i class="icons flaticon-email"></i></label>
            </li>
        </ul>
        <?php
    }
    public static function field_about_btn_skill(){
        $about_btn_skill = get_option('about_btn_skill');
        $about_icon_skill = get_option('about_icon_skill');
        ?>
        <ul class="elem-group">
            <li class="elem-item">
                <input type="checkbox" id="about_btn_skill" name="about_btn_skill" value="1" <?php checked(1, $about_btn_skill, true); ?> />
                <label for=""><?php _e("Afficher le bouton", "MyPortfolio"); ?></label>
            </li>
            <li class="elem-item">
                <input type="checkbox" id="about_icon_skill" name="about_icon_skill" value="1" <?php checked(1, $about_icon_skill, true); ?> />
                <label for=""><?php _e("Afficher l'icône", "MyPortfolio"); ?><i class="icons flaticon-skills"></i></label>
            </li>
        </ul>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_about')){
    mycustome_about::register();
}