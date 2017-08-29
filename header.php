<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title><?php if ( !is_front_page() ) { wp_title( '|', true, 'right' ); } bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body>

<header id="main">
    <div id="logo">
        <a href="<?php echo get_home_url(); ?>" title="Home"><img src="<?php echo get_template_directory_uri(); ?>/images/preload/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?> - Home" /></a>
    </div>
    <button id="menu_btn"></button>
    <div id="menu">
        <button id="menu_close"></button>
        <div id="search_mobile">
            <?php get_search_form(); ?>
        </div>
        <?php wp_nav_menu( [ 'theme_location' => 'header_menu', 'menu_id' => 'primary-menu' ] ); ?>
    </div>
</header>