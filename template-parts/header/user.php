<?php
/**
 * Name file: user
 * Description: Display section user in the header
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="sidebar-head">
    <!--  picture  -->
    <?php if(checked(1, get_option('sidebar_user_picture'), false)) : ?>
        <?php if(checked(1, get_option('sidebar_choose_picture'), false)) : ?>
            <img src="<?php echo esc_attr(get_option('myprofil')); ?>"
                 alt="<?php echo esc_attr(get_option('myfirstname')); ?> <?php echo esc_attr(get_option('mylastname')); ?>"
                 class="profil rounded-full"
            />
        <?php elseif (checked(2, get_option('sidebar_choose_picture'), false)) : ?>
            <img src="<?php echo esc_attr(get_option('myavatar')); ?>"
                 alt="<?php echo esc_attr(get_option('myfirstname')); ?> <?php echo esc_attr(get_option('mylastname')); ?>"
                 class="profil rounded-full"
            />
        <?php elseif (checked(3, get_option('sidebar_choose_picture'), false)) : ?>
            <img src="<?php echo esc_attr(get_option('mylogo')); ?>"
                 alt="<?php echo esc_attr(get_option('myfirstname')); ?> <?php echo esc_attr(get_option('mylastname')); ?>"
                 class="profil rounded-full"
            />
        <?php endif; ?>
    <?php endif; ?>

    <!--  Name  -->
    <h1 class="name font-bold tracking-4">
        <?php if(checked(1, get_option('sidebar_user_firstname'), false)): ?>
            <?php echo esc_attr(get_option('myfirstname')); ?>
        <?php endif; ?>
        <?php if(checked(1, get_option('sidebar_user_lastname'), false)): ?>
            <span class="uppercase"><?php echo esc_attr(get_option('mylastname')); ?></span>
        <?php endif; ?>
    </h1>

    <!--  Job  -->
    <?php if(checked(1, get_option('sidebar_user_job'), false)) : ?>
        <p class="font-thin tracking-3">
            <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                <?php echo esc_attr(get_option('job_title_fr')); ?>
            <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                <?php echo esc_attr(get_option('job_title_en')); ?>
            <?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
                <?php echo esc_attr(get_option('job_title_it')); ?>
            <?php endif; ?>
        </p>
    <?php endif; ?>


</div>
