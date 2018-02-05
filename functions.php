<?php
/**
 * tater functions and definitions
 *
 * @package tater
 */

require_once "shortcodes/sitemap.php";
require_once "woocommerce/woocommerce_functions.php";

/**
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
 * Declare Theme Menus
 */
register_nav_menus( [
    'header_menu' => 'Header Main Navigation Menu',
    'footer_menu' => 'Footer Main Navigation Menu',
] );

/**
 * Theme CSS and JS Scripts
 */
function theme_scripts()
{
    //normalize
    wp_enqueue_script('jquery');

    //css
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    //wp_enqueue_style( 'google_font_kreon', 'https://fonts.googleapis.com/css?family=Kreon:200,400,700,900');

    //js
    wp_enqueue_script( 'preload_directory', get_template_directory_uri() . '/js/preload_directory.js',  time() );
    //wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/966d4a5f64.js', time() );
    wp_enqueue_script( 'mobile-menu', get_template_directory_uri() . '/js/mobile_menu.js', time(), true );
    wp_enqueue_script( 'videoWrapper', get_template_directory_uri() . '/js/videoWrapper.js',  time() );
    wp_enqueue_script( 'smooth_scroll', get_template_directory_uri() . '/js/smooth_scroll.js',  time() );
    wp_enqueue_script( 'pdf_css_icon_add', get_template_directory_uri() . '/js/pdf_css_icon_add.js', time() );

    //localized
    wp_localize_script('preload_directory', 'ajax', [
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('preload_directory')
    ]);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * Remove auto-linking of upload image in Media Library
 */
function theme_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'theme_imagelink_setup', 10);

/**
 * Login Screen CSS
 */
function theme_login_script()
{
    wp_enqueue_style( 'login_custom_style', get_stylesheet_directory_uri(). '/login_view.css', ['login'] );
}
add_action( 'login_enqueue_scripts', 'theme_login_script', 1 );

/**
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
 * Featured images in Page Edit
 */
add_theme_support( 'post-thumbnails' );

/**
 * Template Engine
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
 * Preloading Directory of Files
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

/*
 * Convert Normal YouTube link into embed code
 * Turns - https://www.youtube.com/watch?v=Aq-d4CET3rY
 * into - Aq-d4CET3rY
 *
 * function will need to be echo'd
 *
 * @param $youtube_url
 * @return mixed
 */
function youtube_url_to_embed($youtube_url) {
    $search = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
    $replace = "youtube.com/embed/$1";
    $embed_url = preg_replace($search,$replace,$youtube_url);

    return $embed_url;
}

/**
 * Output YouTube Iframe Embed
 *
 * using helper function youtube_url_to_embed
 *
 * function will need to be echo'd
 * @param $embed_url
 * @return string
 */
function youtube_embed_iframe($embed_url) {
    $iframe = '<iframe title="YouTube video player" class="youtube-player" type="text/html"  src="'.$embed_url.'"
frameborder="0" allowFullScreen></iframe>';

    //videoWrapper will be automatically added due to videoWrapper.js

    return $iframe;
}

/**
 * Get Featured Image
 *
 * Return a featured image of any Post with size passed in
 *
 * @param $id
 * @param $size - defaults to 'small' if none passed in
 * @return string
 */
//@TODO:create and provide placeholder image
function getFeaturedImage($id, $size) {
    $size = ($size) ? $size : 'small';

    $tub = get_the_post_thumbnail($id, $size);

    if (empty($tub)) {
        return "<img src='"
            . get_template_directory_uri()
            . "/images/preload/featured_image_placeholder.png' alt='Placeholder image' />";
    } else {
        return $tub;
    }
}

/**
 * Return Page Featured Image Banner
 *
 * Return a featured image as a page banner,
 * or a placeholder banner
 *
 * @return string
 */
function getPageFeaturedImageBanner() {
    $tub = get_the_post_thumbnail(null, 'full');

    if (empty($tub)) {
        return "<img src='"
            . get_template_directory_uri()
            . "/images/preload/page_banner_placeholder.jpg' alt='"
            . get_the_title()
            . "' />";
    } else {
        return $tub;
    }
}

/**
 * Page Banner Image
 *
 * pipes in the featured image from Page
 * pipes in headline title of Page
 * select if you want it as a parallax or non-parallax section
 * @param int $parallax set to default false
 */
function pageBannerImage($parallax = 0) {
    switch ($parallax):
        case 0://if no, show regular style
            include_once 'templates/pageBannerImageRegular.php';
            break;
        case 1://if yes, show as parallax effect
            include_once 'templates/pageBannerImageParallax.php';
            break;
    endswitch;
}

/**
 * WP 404 Alerts
 *
 * send email to theme developer when 404 hit
 * and update error_log with url, time, and IP
 *
 * method is called on 404.php
 */
function four_oh_four_alert() {
    //set status
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");

    //site info
    $blog  = get_bloginfo('name');
    $site  = get_bloginfo('url') . '/';
    $email_send = 'zach@zachis.it';
    $email_from = get_bloginfo('admin_email');

    //referrer
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = clean($_SERVER['HTTP_REFERER']);
    } else {
        $referer = "undefined";
    }

    //request URI
    if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['HTTP_HOST'])) {
        $request = clean('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    } else {
        $request = 'undefined';
    }

    //query string
    if (isset($_SERVER['QUERY_STRING'])) {
        $string = clean($_SERVER['QUERY_STRING']);
    } else {
        $string = 'undefined';
    }

    //IP address
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $address = clean($_SERVER['REMOTE_ADDR']);
    } else {
        $address = 'undefined';
    }

    //user agent
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $agent = clean($_SERVER['HTTP_USER_AGENT']);
    } else {
        $agent = 'undefined';
    }

    //identity
    if (isset($_SERVER['REMOTE_IDENT'])) {
        $remote = clean($_SERVER['REMOTE_IDENT']);
    } else {
        $remote = 'undefined';
    }

    //log time
    $time = clean(date('F jS Y, h:ia', time()));

    //sanitize
    function clean($string) {
        $string = rtrim($string);
        $string = ltrim($string);
        $string = htmlentities($string, ENT_QUOTES);
        $string = str_replace("\n", "<br>", $string);

        if (get_magic_quotes_gpc()) {
            $string = stripslashes($string);
        }
        return $string;
    }

    $message =
        'TIME: '            . $time    . "\n" .
        '*404: '            . $request . "\n" .
        'SITE: '            . $site    . "\n" .
        'REFERRER: '        . $referer . "\n" .
        'QUERY STRING: '    . $string  . "\n" .
        'REMOTE ADDRESS: '  . $address . "\n" .
        'REMOTE IDENTITY: ' . $remote  . "\n" .
        'USER AGENT: '      . $agent   . "\n\n\n";

    //send mail based on mail() or smtp delivery methods
    if (in_array('mail', explode(';', ini_get('disable_functions')))) {
        mail($email_send, "404 Alert: " . $blog . "", $message, "From: $email_from");

        //set error log message
        error_log('404 hit on '. $referer . ' with an IP of '. $agent .'. Email via mail() is sent!');
    } else {
        //set up smtp
        ini_set('SMTP', 'aspmx.l.google.com');
        ini_set('sendmail_from', 'zacharyrs@gmail.com');

        mail($email_send, "404 Alert: " . $blog . "", $message, "From: $email_from");

        //set error log message
        error_log('404 hit on '. $referer . ' with an IP of '. $agent .'. Email via SMTP is sent!');
    }
}

/**
 * Plugins Required For Theme
 *
 * some plugins help the theme run as expected
 * if a required plugin is missing, alert admin user
 */
function checkPluginsRequired() {
    $plugin_messages = [];

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    //get theme information
    $this_theme = wp_get_theme();
    $this_theme_name = $this_theme->get('Name');
    $this_theme_version = $this_theme->get('Version');

    //WP-SCSS Plugin
    if(!is_plugin_active( 'wp-scss/wp-scss.php' ))	{
        $plugin_messages[] = 'The '.$this_theme_name.' v.'.$this_theme_version.' theme requires you to install the WP-SCSS plugin - <a href="https://wordpress.org/plugins/wp-scss/" title="Download the required plugin here" target="_blank">download it from here</a> or activate if currently installed.';
    }

    /*further plugins would be written in the following format
    //WooCommerce Plugin
    if(!is_plugin_active( 'woocommerce/woocommerce.php' ))	{
        $plugin_messages[] = 'The '.$this_theme_name.' v.'.$this_theme_version.' theme requires you to install the WooCommerce plugin - <a href="https://wordpress.org/plugins/woocommerce/" title="Download the required plugin here" target="_blank">download it from here</a> or activate if currently installed.';
    }
    */

    if(count($plugin_messages) > 0)	{
        echo '<div id="message" class="error">';

        foreach($plugin_messages as $message) {
            echo '<p><strong>'.$message.'</strong></p>';
        }

        echo '</div>';
    }
}

add_action('admin_notices', 'checkPluginsRequired');

/**
 * Return Page content per ID passed in
 * @param $page
 * @return mixed
 */
function get_page_content($page) {
    $page_id = $page;
    $page_data = get_page( $page_id );
    $content = apply_filters('the_content', $page_data->post_content);

    return $content;
}

/**
 * Get Latest Post
 *
 * pipe in category_slug and how many posts
 * to return basic wp_query
 *
 * @param $category_slug
 * @param $return_number
 * @param bool $title
 * @param bool $excerpt
 * @param bool $readmore
 * @param bool $date
 */
function get_latest_post($category_slug, $return_number, $title = false, $excerpt = false, $readmore = false, $date = false) {
    $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $return_number,
        'order' => 'DSC',
        'category_name' => $category_slug
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php if ($title) : ?><div class="title"><?=the_title()?></div><?php endif; ?>
            <?php if ($date) : ?><div class="date"><?=the_date()?></div><?php endif; ?>
            <?=getFeaturedImage(get_the_ID(), 'medium')?>
            <?php if ($excerpt) : ?><div class="excerpt"><?=the_excerpt()?></div><?php endif; ?>
            <?php if ($readmore) : ?><div class="readmore"><a href="<?=the_permalink()?>" title="<?=the_title(); ?>">read more</a></div><?php endif; ?>
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
}

/**
 * Image Creator
 *
 * output the image src html tag
 * used primarily on product single view
 * until we build media manager handlers for this screen
 * @param $image_url
 * @param bool $alt
 * @param bool $class
 * @return string
 */
function image_creator($image_url, $alt=false, $class=false) {
    $string = '<img src='.$image_url.' alt='.$alt.' class='.$class.'>';
    return $string;
}

/**
 * Determine Page ID of any Page/Post
 *
 * @param $pid
 * @return bool
 */
function is_tree($pid) {
    global $post;

    if(is_page()&&($post->post_parent==$pid||is_page($pid)))
        return true;
    else
        return false;
};

/**
 * General Image Fallback
 *
 * in a general instance, pipe in desired image asset
 * if not available, then show placeholder image
 *
 * placeholder image is general placeholder sitting in root of theme/images/
 *
 * @param $wantedAsset
 * @param $post
 */
function generalFallBackImageHandling($wantedAsset, $post) {
    if (!$wantedAsset) : ?>
        <?=image_creator(get_template_directory_uri().'/images/placeholder.png', 'placeholder image') ?>
    <?php else : ?>
        <?=$wantedAsset?>
    <?php endif;
}