<?php
/**
 * Name file: en-list
 * Description: display this part if get_locale() is same as 'en_GB'
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div class="about-detail">
    <h3><?php _e("Détails personnels", "MyPortfolio")  ?></h3>
    <ul>
        <?php if(checked(1, get_option('about_show_fullname'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e("Nom", "MyPortfolio"); ?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('myfirstname'); ?> <span class="uppercase"><?php echo get_option('mylastname'); ?></span>
            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('about_show_age'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e("Âge", "MyPortfolio"); ?></span>
                <span class="detail-separater"></span>
                <?php
                    $dateOfBirth = new DateTime(get_option('mybirthday'));
                    $myAge = $dateOfBirth -> diff(new DateTime);
                    echo $myAge -> y;
                ?>
            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('about_show_country'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e("Localité", "MyPortfolio"); ?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('mylocation'); ?> (<?php _e("Belgique", "MyPortfolio"); ?>)
            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('about_show_job'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e("Poste", "MyPortfolio"); ?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('job_title_en'); ?>
            </li>
        <?php endif; ?>

    </ul>
</div>
