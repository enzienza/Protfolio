<?php
/**
 * Name file: footer
 * Description: the template for displaying the footer
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>


<footer class="footer">
    <small class="">
        <?php if(checked(1, get_option('footer_type'), false)) : ?>
            <?php get_template_part('template-parts/footer/copyright') ?>
        <?php elseif(checked(2, get_option('footer_type'), false)) : ?>
            <div class="my-container flex-between">
                <?php get_template_part('template-parts/footer/copyright') ?>
                <?php get_template_part('template-parts/footer/legal') ?>
            </div>
        <?php endif; ?>
    </small>
</footer>

<?php wp_footer(); ?>
</body>
</html>
