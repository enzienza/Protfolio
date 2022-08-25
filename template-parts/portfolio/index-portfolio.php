<?php
/**
 * Name file: index-portfolio
 * Description: display portfolio section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div id="portfolio" class="my-container">
    <div class="title-section">
        <?php require_once ("title/title.php")?>
    </div>

    <?php if(checked(1, get_option('portfolio_show_desc'), false)) : ?>
        <?php require_once ("description/desc.php")?>
    <?php endif; ?>

    <div>
        <?php require_once ("works/work.php")?>
    </div>

</div>
