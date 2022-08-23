<?php
/**
 * Name file: image
 * Description: show picture on about section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php if(checked(1, get_option('about_picture'), false)) : ?>
    <img src="<?php echo get_option('myavatar') ?>"
         alt="<?php echo get_option('myfirstname') ?> <?php echo get_option('mylastname') ?>"
         class="morph"
    />
<?php elseif(checked(2, get_option('about_picture'), false)) : ?>
    <img src="<?php echo get_option('myprofil') ?>"
         alt="<?php echo get_option('myfirstname') ?> <?php echo get_option('mylastname') ?>"
         class="morph"
    />
<?php endif; ?>