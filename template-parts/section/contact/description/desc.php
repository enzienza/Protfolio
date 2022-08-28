<?php
/**
 * Name file: desc
 * Description: show description on contact section
 * Important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <div class="desc-section">
        <div class="font-light mb-4">
            <?php echo get_option('contact_desc_fr'); ?>
        </div>
    </div>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <div class="desc-section">
        <div class="font-light mb-4">
            <?php echo get_option('contact_desc_en'); ?>
    </div>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <div class="desc-section">
        <div class="font-light mb-4">
            <?php echo get_option('contact_desc_it'); ?>
        </div>
    </div>
<?php endif; ?>