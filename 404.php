<?php
/**
 * Name file: 404
 * Description: The template for displaying 404 pags (not found)
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php get_header(); ?>
<section id="error-page" class="error">
    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
        <?php get_template_part('template-parts/error/fr', 'error') ?>
    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
        <?php get_template_part('template-parts/error/en', 'error') ?>
    <?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
        <?php get_template_part('template-parts/error/it', 'error') ?>
    <?php endif; // ================================================= ?>
</section>
<?php get_footer(); ?>
