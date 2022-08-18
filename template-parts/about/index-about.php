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
    <div class="grid grid-cols-2 about-grid">
        <div class="about-content">
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
            </div>
        <?php elseif(checked(2, get_option('about_right_design'), false)) : ?>
            <div class="about-details">
                <?php require_once ("complementary/info.php"); ?>
            </div>

        <?php endif; ?>


    </div>
</div>