<?php
/**
 * Name file: desc
 * Description: show list counter complementary info on about section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="counter">
    <?php if(checked(1, get_option('about_years_experience'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">
                <?php
                $dateOfStart = new DateTime(get_option('years_experience'));
                $myExperience = $dateOfStart -> diff(new DateTime);
                echo $myExperience -> y;
                ?>
            </p>
            <p class="counter-title"><?php _e("Années d'experience", "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_formations'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb"><?php echo get_option('numb_formation'); ?></p>
            <p class="counter-title"><?php _e('Nombre de formation', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_languanges'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb"><?php echo get_option('numb_languanges'); ?></p>
            <p class="counter-title"><?php _e('Langage web', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_repository'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb"><?php echo get_option('numb_repository'); ?></p>
            <p class="counter-title"><?php _e('Repositories GitHub', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_all_project'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">30</p>
            <p class="counter-title"><?php _e('Projets achevés', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_web_project'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">7</p>
            <p class="counter-title"><?php _e('Projet web', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_proto_project'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">7</p>
            <p class="counter-title"><?php _e('Projet prototypage', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_graph_project'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">7</p>
            <p class="counter-title"><?php _e('Projet graphique', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_real_client'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">7</p>
            <p class="counter-title"><?php _e('Projet clients', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_satisfied_client'), false)) : ?>
        <div class="counter-box">
            <p class="counter-numb">7</p>
            <p class="counter-title"><?php _e('Clients satisfaits', "MyPortfolio"); ?></p>
        </div>
    <?php endif; ?>

</div>