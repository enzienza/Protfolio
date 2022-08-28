<?php
/**
 * Name file: en-btn
 * Description: display this part if get_locale() is same as 'en_BG'
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="group-btn">

    <?php if(checked(1, get_option('about_btn_download'), false)) : ?>
        <a href="<?php echo get_option('curriculum_en') ?>" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('about_icon_download'), false)) : ?>
                <i class="icons flaticon-download"></i>
            <?php endif; ?>
            <?php _e("Download CV", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_btn_contact'), false)) : ?>
        <a href="#contact" class="btn btn-simple">
            <?php if(checked(1, get_option('about_icon_contact'), false)) : ?>
                <i class="icons flaticon-email"></i>
            <?php endif; ?>
            <?php _e("Contactez-moi", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_btn_skill'), false)) : ?>
        <a href="<?php echo get_option('mysiteweb');?>#skills" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('about_icon_skill'), false)) : ?>
                <i class="icons flaticon-skills"></i>
            <?php endif; ?>
            <?php _e("Mes compétences", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>
</div>