<?php
/**
 * Name file: index-home
 * Description: display home section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div id="home" class="my-container" <?php if(checked(1, get_option('add_bg_hero'))) : ?>style="background-image: url(<?php echo get_option('bg_hero'); ?>)" <?php endif; ?>>
    <div class="jumb-content">
        <?php require_once('content/contents.php');?>
        <?php require_once('button/buttons.php');?>
    </div>
</div>
