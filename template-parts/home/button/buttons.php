<?php
/**
 * Name file: buttons
 * Description: show buttons on about section
 * important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>


<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <?php require_once('fr-btn.php'); ?>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <?php require_once('en-btn.php'); ?>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <?php require_once('it-btn.php') ;?>
<?php endif; ?>