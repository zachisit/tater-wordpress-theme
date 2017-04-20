<?php
/**
 * tater functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tater
 */

/*************************************************
 * hide wp admin bar
 *************************************************/
show_admin_bar( false );

/*************************************************
 * widgetize theme
 **************************************************/
function arphabet_widgets_init() {

    register_sidebar( array(
        'name' => 'Internal Sidebar',
        'id'   => 'internal-sidebar',
        'description'   => 'Widgetized sidebar for all internal pages.',
        'before_widget' => '<div class="widgetblock">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );

    //additional sidebars here
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/*************************************************
 * declare theme menus
 **************************************************/
register_nav_menus( array(
    'header_menu' => 'Header Main Navigation Menu',
    'footer_menu' => 'Footer Main Navigation Menu',
) );

/*************************************************
 * css and js scripts
 **************************************************/
function theme_scripts() {
    //normalize
    wp_enqueue_script('jquery');
    
    //css
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

    //js
    //wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/*************************************************
 * featured images in Page Edit
 **************************************************/
add_theme_support( 'post-thumbnails' );


/***********************************************************************
 * backend styling
 ***********************************************************************/
function admin_login_logo() {
    ?>
    <style type="text/css">
        body {
            background:black !important;
        }
        .login #backtoblog a:focus, .login #nav a:focus, .login h1 a:focus, .login #backtoblog a, .login #nav a {
            color:white !important;
        }
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/logo.png);
            height:180px;
            background-size:180px;
            width:210px;
            height:212px;
            background-position:center;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'admin_login_logo' );

/***********************************************************************
 * determine if page is in certain parent page
 * @source: https://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/
 ***********************************************************************/
function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
    global $post;         // load details about this page
    if(is_page()&&($post->post_parent==$pid||is_page($pid)))
        return true;   // we're at the page or at a sub page
    else
        return false;  // we're elsewhere
};

?>