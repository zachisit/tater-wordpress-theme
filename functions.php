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
    wp_enqueue_script( 'mobile-menu', get_template_directory_uri() . '/js/mobile_menu.js', array(), '20180428', true );
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

/*************************************************************
 * # Example CPT
 *************************************************************/
//register the CPT
function wpt_event_posttype() {
    register_post_type( 'events',
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' ),
                'add_new' => __( 'Add New Event' ),
                'add_new_item' => __( 'Add New Event' ),
                'edit_item' => __( 'Edit Event' ),
                'new_item' => __( 'Add New Event' ),
                'view_item' => __( 'View Event' ),
                'search_items' => __( 'Search Event' ),
                'not_found' => __( 'No events found' ),
                'not_found_in_trash' => __( 'No events found in trash' )
            ),
            'public' => true,
            'supports' => array( 'title', 'thumbnail' ),
            'capability_type' => 'post',
            'rewrite' => array("slug" => "events"), // Permalinks format
            'menu_position' => 5,
            'register_meta_box_cb' => 'add_events_metaboxes'
        )
    );
}

add_action( 'init', 'wpt_event_posttype' );

// Add the Events Meta Boxes

function add_events_metaboxes() {
    add_meta_box('wpt_events_location', 'Event Location', 'wpt_events_location', 'events', 'side', 'default');
}

// The Event Location Metabox

function wpt_events_location() {
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    // Get the location data if its already been entered
    $location = get_post_meta($post->ID, '_location', true);

    // Echo out the field
    echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';

}

// Save the Metabox Data

function wpt_save_events_meta($post_id, $post) {

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    $events_meta['_location'] = $_POST['_location'];

    // Add values of $events_meta as custom fields

    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields
?>