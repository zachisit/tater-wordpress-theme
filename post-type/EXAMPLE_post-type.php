<?php
/**
 * Team Member Custom Post Type
 *
 * Example structure for CPT
 *
 * Reference to this file to be as a 'require_once'
 * via functions.php file
 *
 * @package tater
 * @version 1.0.1
 */

function mrl_team_member_posttype() {
    register_post_type( 'team_member',
        [
            'labels' => [
                'name' => __( 'Team Members' ),
                'singular_name' => __( 'Team Member' ),
                'add_new' => __( 'Add New Member' ),
                'add_new_item' => __( 'Add New Team Member' ),
                'edit_item' => __( 'Edit Team Member' ),
                'new_item' => __( 'Add New Team Member' ),
                'view_item' => __( 'View Team Members' ),
                'search_items' => __( 'Search Team Members' ),
                'not_found' => __( 'No Team Members found' ),
                'not_found_in_trash' => __( 'No Team Members found in trash' )
            ],
            'public' => true,
            'supports' => [ 'title', 'revisions', 'page-attributes', 'thumbnail'],
            'capability_type' => 'post',
            'rewrite' => [ "slug" => "team_member" ],
            'menu_position' => 5,
            'register_meta_box_cb' => 'add_team_member_metaboxes',
            'menu_icon' => 'dashicons-admin-users',
            'media_buttons' => false,
            'show_in_nav_menus' => false,
        ]
    );
}
add_action( 'init', 'mrl_team_member_posttype' );

//create and show metaboxes
function add_team_member_metaboxes() {
    add_meta_box('mrl_team_member_meta_values', 'Team Member Specifics', 'mrl_team_member_meta_values', 'team_member', 'normal', 'default');
}