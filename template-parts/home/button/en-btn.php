<?php
/**
 * Name file: en-btn
 * Description: display this part if get_locale() is same as 'en_GB'
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="group-btn">
    <?php if(checked(1, get_option('hero_btn_about'), false)) : ?>
        <a href="#about" class="btn btn-simple">
            <?php if(checked(1, get_option('hero_icon_about'), false)) : ?>
                <i class="icons flaticon-user"></i>
            <?php endif; ?>
            <?php _e("About", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_btn_download'), false)) : ?>
        <a href="<?php echo get_option('curriculum_en') ?>" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('hero_icon_download'), false)) : ?>
                <i class="icons flaticon-download"></i>
            <?php endif; ?>
            <?php _e("Download CV", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_btn_contact'), false)) : ?>
        <a href="#contact" class="btn btn-simple">
            <?php if(checked(1, get_option('hero_icon_contact'), false)) : ?>
                <i class="icons flaticon-email"></i>
            <?php endif; ?>
            <?php _e("Contactez-moi", "MyPortfolio"); ?>
        </a>
    <?php endif; ?>
</div>