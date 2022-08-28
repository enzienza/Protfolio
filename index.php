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
        <?php get_template_part('template-parts/section/home/index', 'home') ?>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_hidden_section'), false)) : else : ?>
        <?php get_template_part('template-parts/section/about/index', 'about') ?>
    <?php endif; ?>

    <?php if(checked(1, get_option('portfolio_hidden_section'), false)) : else : ?>
        <?php get_template_part('template-parts/section/portfolio/index', 'portfolio') ?>
    <?php endif; ?>


    <div id="contact" class="my-container" style="height: 100vh">
        <h1>Contact section</h1>
    </div>
<?php get_footer(); ?>