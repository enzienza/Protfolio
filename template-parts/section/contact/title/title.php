<?php
/**
 * Name file: title
 * Description: show title on contact section
 * Important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>


<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <h1><?php echo get_option('contact_title_fr'); ?></h1>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <h1><?php echo get_option('contact_title_en'); ?></h1>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <h1><?php echo get_option('contact_title_it'); ?></h1>
<?php endif; ?>