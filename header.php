<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title><?php if ( !is_front_page() ) { wp_title( '|', true, 'right' ); } bloginfo( 'name' ); ?></title>

    <!-- Apple/Safari icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://codetheweb.blog/assets/img/posts/html-icons/icon180.png">
    <!-- Square Windows tiles -->
    <meta name="msapplication-square70x70logo" content="https://codetheweb.blog/assets/img/posts/html-icons/icon70.png">
    <meta name="msapplication-square150x150logo" content="https://codetheweb.blog/assets/img/posts/html-icons/icon150.png">
    <meta name="msapplication-square310x310logo" content="https://codetheweb.blog/assets/img/posts/html-icons/icon310.png">
    <!-- Rectangular Windows tile -->
    <meta name="msapplication-wide310x150logo" content="https://codetheweb.blog/assets/img/posts/html-icons/icon-rect-310.png">
    <!-- Windows tile theme color -->
    <meta name="msapplication-TileColor" content="#2e2e2e">

    <?php wp_head(); ?>
</head>
<body>

<header>
    <div id="logo">
        <a href="<?=home_url()?>"
           title="<?=home_url()?> Home"
        ><img src="<?=get_template_directory_uri() ?>/images/preload/logo1.png"
              alt="<?=get_bloginfo('name')?> - <?=get_home_url()?> Logo" />
        </a>
    </div>
    <button id="menu_btn"></button>
    <div id="menu">
        <button id="menu_close"></button>
        <div id="search_mobile">
            <?php get_search_form()?>
        </div>
        <?php wp_nav_menu(['theme_location' => 'header_menu','menu_id' => 'primary-menu'])?>
    </div>
</header>