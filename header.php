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
    <div id="menu">
        <a href="javascript:void(0);" id="menu_btn"><div class="mobilemenubars"></div><div class="mobilemenubars"></div><div class="mobilemenubars"></div></a>
        <div id="menu"><a href="#" id="menu_close">X</a>
        <?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'menu_id' => 'primary-menu' ) ); ?>
    </div>
</header>