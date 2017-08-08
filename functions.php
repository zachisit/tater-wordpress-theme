<?php
/**
 * tater functions and definitions
 *
 * @package tater
 */

/**
 * ---
 * Widgetize Theme
 */
function theme_widgets_init()
{
    register_sidebar( [
        'name' => 'Internal Sidebar',
        'id'   => 'internal-sidebar',
        'description'   => 'Widgetized sidebar for all internal pages.',
        'before_widget' => '<div class="widgetblock">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ] );

    //additional sidebars here
}
add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * ---
 * Declare Theme Menus
 */
register_nav_menus( [
    'header_menu' => 'Header Main Navigation Menu',
    'footer_menu' => 'Footer Main Navigation Menu',
] );

/**
 * ---
 * Theme CSS and JS Scripts
 */
function theme_scripts()
{
    //normalize
    wp_enqueue_script('jquery');

    //css
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

    //js
    wp_enqueue_script( 'mobile-menu', get_template_directory_uri() . '/js/mobile_menu.js', time(), true );
    wp_enqueue_script( 'videoWrapper', get_template_directory_uri() . '/js/videoWrapper.js',  time() );
    wp_enqueue_script( 'preloading_directory', get_template_directory_uri() . '/js/preload_directory.js',  time() );
    wp_enqueue_script( 'smooth_scroll', get_template_directory_uri() . '/js/smooth_scroll.js',  time() );
    wp_enqueue_script( 'pdf_css_icon_add', get_template_directory_uri() . '/js/pdf_css_icon_add.js', time() );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * ---
 * Login Screen CSS
 */
function theme_login_script()
{
    wp_enqueue_style( 'login_custom_style', get_stylesheet_directory_uri(). '/login_view.css', ['login'] );
}
add_action( 'login_enqueue_scripts', 'theme_login_script', 1 );

/**
 * ---
 * Admin CSS and JS
 */
function theme_admin_script()
{
    //css
    wp_enqueue_style( 'theme_admin_css', get_template_directory_uri() . '/admin.css' );

    //scss
    wp_enqueue_style( get_template_directory_uri() . 'admin.scss' );
}
add_action( 'admin_enqueue_scripts', 'theme_admin_script');

/**
 * ---
 * Featured images in Page Edit
 */
add_theme_support( 'post-thumbnails' );

/**
 * ---
 * Featured images in Page Edit
 * Takes a template file and populates it into a string that is returned
 * @param $templateFile
 * @param array $args
 * @return string
 */
function populate_template_file($templateFile, $args = [])
{
    ob_start(); //start output buffer

    $templateDirectory = dirname(__FILE__) . '/templates';
    $templateFile = $templateFile . '.template.php';
    //Confirm that template file exists
    if(file_exists($templateDirectory . '/' . $templateFile)){
        extract($args); //populate args into variables
        include $templateDirectory . '/' . $templateFile; //Include template file, make sure you are passing the required variables.
    }

    return ob_get_clean();
}

/**
 * preload entire dir
 * @return: json encoded string
 */
function XXX_theme_preload_dir() {
    header( 'Content-type: application/json' );

    $filenameArray = [];
    $templatePath = get_template_directory_uri();

    $handle = opendir(dirname(realpath(__FILE__)). '/images/preload/');

    while($file = readdir($handle)){
        if($file !== '.' && $file !== '..'){
            array_push($filenameArray, "$templatePath/images/preload/$file");
        }
    }

    echo json_encode($filenameArray);

    wp_die();//need to do at end of ajax calls to stop
}

add_action('wp_ajax_preload_images_directory', 'XXX_theme_preload_dir');
add_action('wp_ajax_nopriv_preload_images_directory', 'XXX_theme_preload_dir');