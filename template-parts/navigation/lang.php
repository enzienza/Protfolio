<?php
/**
 * Name file: lang
 * Description: Display languages navigation (switcher). This Navigation is fixe
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="sidebar-top">
    <?php
    /**
     * [navigation languages]
     */
    wp_nav_menu(array(
        'theme_location' => 'top',
        'depth'          => 2,
        'container'      => false,
        'menu_class'     => 'nav-lang'
    ));
    ?>
</div>