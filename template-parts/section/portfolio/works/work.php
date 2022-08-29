<?php
/**
 * Name file: work
 * Description: show work on portfolio section
 * Important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<!-- provisoir -->
<!-- loop if -->
<!-- loop else -->
<div class="no-result">

    <?php if(checked(1, get_option('portfolio_loop_emoji'), false)) : ?>
        <p class="display-1">&#128549;</p>
    <?php endif; ?>

    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
        <p class="no-result-msg">
            <?php echo get_option('portfolio_loop_fr'); ?>
        </p>
    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('portfolio_loop_it'); ?>
        </p>
    <?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('portfolio_loop_en'); ?>
        </p>
    <?php endif; ?>
</div>

<!-- loop endif -->