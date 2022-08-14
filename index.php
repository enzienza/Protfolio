<?php
/**
 * Name file: index
 * Description: the main template file
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php get_template_part('template-parts/components/switch-mode') ?>

    <?php if(checked(1, get_option('hero_hidden_section'), false)) : else : ?>
        <?php get_template_part('template-parts/home/index', 'home') ?>
    <?php endif; ?>

    <div id="about" class="my-container" style="height: 100vh">
        <h1>About section</h1>
    </div>
    <div id="portfolio" class="my-container" style="height: 100vh">
        <h1>Portfolio section</h1>
    </div>
    <div id="contact" class="my-container" style="height: 100vh">
        <h1>Contact section</h1>
    </div>
<?php get_footer(); ?>