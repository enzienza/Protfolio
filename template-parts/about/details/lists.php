<?php
/**
 * Name file: desc
 * Description: show lists for personal details on about section
 * Important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>


<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <?php require_once('fr-list.php'); ?>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <?php require_once('en-list.php'); ?>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <?php require_once('it-list.php') ;?>
<?php endif; ?>