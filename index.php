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

    <?php if(checked(1, get_option('contact_hidden_section'), false)) : else : ?>
        <?php get_template_part('template-parts/section/contact/index', 'contact') ?>
    <?php endif; ?>

<?php get_footer(); ?>