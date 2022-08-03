<?php
/**
 * Name file: header
 * Description: the template for displaying the header
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- ============= META ============= -->
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- ============= INFORMATIONS  ============= -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="Enza Lombardo">

    <title><?php bloginfo('title'); ?></title>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="sidebar">
    <!--  Nav-lang  -->
    <?php get_template_part('template-parts/navigation/lang'); ?>

    <!--  Box-user  -->
    <?php if(checked(1, get_option('sidebar_hidden_user'), false)) : else: ?>
        <?php get_template_part('template-parts/header/user'); ?>
    <?php endif; ?>

    <!--  Nav-principal  -->
    <?php get_template_part('template-parts/navigation/principal'); ?>

    <!--  Box-network  -->
    <?php if(checked(1, get_option('sidebar_network'), false)) : else: ?>
        <?php get_template_part('template-parts/header/network'); ?>
    <?php endif; ?>
</header>

<!--  BTN-MOBILE  -->
<button class="btn-menu" id="btn-menu" type="button">
    <div class="btn-menu__burger"></div>
</button>