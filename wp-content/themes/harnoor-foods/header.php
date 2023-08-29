<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php get_img('favicon/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php get_img('favicon/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php get_img('favicon/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php get_img('favicon/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php get_img('favicon/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php get_img('favicon/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php get_img('favicon/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php get_img('favicon/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php get_img('favicon/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php get_img('favicon/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php get_img('favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php get_img('favicon/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php get_img('favicon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?php get_img('favicon/manifest.json') ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php
    wp_head();
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
</head>
<header class="main-header">
    <div class="container">
        <div class="header-contents">
            <div class="left-side">
                <a class="logo-box" href="<?php echo site_url(); ?>">
                    <img src="<?php get_img('logo.svg') ?>" alt="">
                </a>
                <div class="search-box">
                    <input type="search" placeholder="Search codify...">
                </div>
            </div>
            <div class="right-side">
                <?php
                $userLoggedin =  is_user_logged_in();
                $loginBtnText = $userLoggedin ? 'Logout' : 'Login';
                $loginBtnLink = $userLoggedin ? '/logout' : '/login';
                if (!(is_page('login') || is_page('registration'))) {
                ?>
                    <a class="btn btn--md" href="<?php echo site_url() . $loginBtnLink ?>"><?php echo $loginBtnText ?></a>
                <?php  } ?>
                <button class="btn btn--md">Subscribe</button>
            </div>
        </div>
    </div>
</header>

<body <?php body_class(); ?>>