<?php
/**
 * Name file: en-desc
 * Description: display this part if get_locale() is same as 'en_GB'
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php
/**
 * get_option => about_message
 * 1 => message aboutme SHORT
 * 2 => messagne aboutme LONG
 */
?>

<?php if(checked(1, get_option('about_message'), false)) : ?>
    <div class="font-light text-justify">
        <?php echo get_option('short_aboutme_en'); ?>
    </div>
<?php elseif(checked(2, get_option('about_message'), false)) : ?>
    <div class="font-light text-justify">
        <?php echo get_option('talk_aboutme_en'); ?>
    </div>
<?php endif; ?>
