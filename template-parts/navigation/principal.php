<?php
/**
 * Name file: Principal
 * Description: Display principal navigation in Aside. This Navigation is fixe
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="sidebar-content">
    <?php
    /**
     * [navigation principal]
     */
    wp_nav_menu(array(
        'theme_location' => 'aside',
        'depth'          => 2,
        'container'      => false,
        'menu_class'     => 'navbar-nav',
    ));
    ?>
</div>
