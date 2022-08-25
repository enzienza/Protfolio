<?php
/**
 * Name file: desc
 * Description: show title on portfolio section
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
            <?php echo get_option('portfolio_desc_fr'); ?>
        </div>
    </div>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <div class="desc-section">
        <div class="font-light mb-4">
            <?php echo get_option('portfolio_desc_en'); ?>
    </div>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <div class="desc-section">
        <div class="font-light mb-4">
            <?php echo get_option('portfolio_desc_it'); ?>
        </div>
    </div>
<?php endif; ?>