<?php
/**
 * Name file: index-about
 * Description: display about section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div id="about" class="my-container">
    <div class="title-section">
        <?php require_once ("title/title.php")?>
    </div>
    <?php if(checked(3, get_option('about_right_design'), false)) : ?>
    <div class="about-flex">
        <div class="about-content w-half">
    <?php else : ?>
    <div class="grid grid-cols-2 about-grid">
        <div class="about-content">
    <?php endif; ?>

            <?php
            /**
             * get_option => about_design_section
             * 1 => description (index add hooks get_locale)
             * 2 => list personal details (index add hooks get_locale)
             * 3 => description + list personal details
             */
            ?>
            <?php if(checked(1, get_option('about_left_design'), false)) : ?>
                <?php require_once ("description/desc.php")?>
            <?php elseif(checked(2, get_option('about_left_design'), false)): ?>
                <?php require_once ("details/lists.php"); ?>
            <?php elseif(checked(3, get_option('about_left_design'), false)): ?>
                <?php require_once ("description/desc.php")?>
                <?php require_once ("details/lists.php"); ?>
            <?php endif; ?>
            <?php require_once("button/buttons.php"); ?>
        </div>

        <?php if(checked(1, get_option('about_right_design'), false)) : ?>
            <div class="about-image">
                <?php require_once ("picture/image.php"); ?>
            </div>
        <?php elseif(checked(2, get_option('about_right_design'), false)) : ?>
            <div class="about-counter">
                <?php require_once ("complementary/info.php"); ?>
            </div>

        <?php elseif(checked(3, get_option('about_right_design'), false)) : ?>
            <div class="about-image w-half">
                <?php require_once ("picture/image.php"); ?>
            </div>
            <div class="about-counter w-full" >
                <?php require_once ("complementary/info.php"); ?>
            </div>
        <?php endif; ?>


    </div>
</div>