<?php
/**
 * Name file: index-contact
 * Description: display contact section
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<div id="contact" class="my-container" style="height: 100vh">
    <div class="title-section">
        <?php require_once("title/title.php") ?>
    </div>

    <?php if(checked(1, get_option('contact_show_desc'), false)) : ?>
        <?php require_once("description/desc.php") ?>
    <?php endif; ?>

    <div class="contact-form" id="my-form">
        <?php require_once("forms/form.php"); ?>
    </div>

    <?php if(checked(1, get_option('contact_network'), false)) : ?>
        <?php require_once("social/network.php") ?>
    <?php endif; ?>
</div>
