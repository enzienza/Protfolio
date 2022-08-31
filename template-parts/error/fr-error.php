<?php
/**
 * Name file: fr-error
 * Description: display this part if get_locale() is same as 'fr_FR'
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="error container">
    <div class="error-code">
        404
    </div><!--//error-code-->

    <h1 class="text-hightlight">
        <?php echo get_option('teaser_error_fr'); ?>
    </h1><!--//text-hightlight-->

    <div class="error-desc">
        <p>
            <?php echo get_option('message_error_fr'); ?>
        </p>

        <?php if(checked(1, get_option('errorpage_back_home'), false)) : ?>
            <div class="btn-container">
                <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="btn btn-outline-simple">
                    <?php _e("Retour à l'accueil", "MyPortfolio"); ?>
                </a>
            </div>
        <?php endif; ?>
    </div><!--//error-desc-->
</div><!--//error-->
