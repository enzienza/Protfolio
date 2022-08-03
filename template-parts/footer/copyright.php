<?php
/**
 * Name file: copyright
 * Description:
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<?php if(checked(1, get_option('footer_format'), false)) : ?>
    <div class="copyright">
        <?php bloginfo('name')?> © 2022 |
        <?php _e("Created by", "MyPortfolio"); ?>
        <a href="http://enzalombardo.be/" target="_blank">Enza Lombardo</a>
    </div>
<?php elseif(checked(2, get_option('footer_format'), false)) : ?>
    <div class="copyright">
        Copyright © 2022 <span class="higt">Enza</span> | <?php _e("All rights reserved", "MyPortfolio") ?>
    </div>
<?php endif; ?>
