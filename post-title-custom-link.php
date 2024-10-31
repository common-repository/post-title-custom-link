<?php
/*
Plugin Name: Post title link 
Plugin URI: https://profiles.wordpress.org/kinjaldalwadi/#content-plugins
Description: Allow to add custom link in post title
Version: 1.0
Author: Kinjal Dalwadi
Author URI: https://profiles.wordpress.org/kinjaldalwadi/
License: GPL2
*/
/**
 * Register meta boxes.
 */
function cfl_register_meta_boxes() {
    add_meta_box( 'cfl-1', __( 'Post Title Custom Link', 'cfl' ), 'cfl_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'cfl_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function cfl_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './include/metaboxes.php';
}

function cfl_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'post_custom_external_url',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'cfl_save_meta_box' );

//Version to check if we're on the home page as well
add_filter('post_link','cfl_custom_url',10,3);
function cfl_custom_url( $permalink, $post, $leavename ) {
    $custom = false;

    if( is_home() || is_front_page() )
        $custom = get_post_meta( $post->ID, 'post_custom_external_url', true );

    return ( $custom ) ? esc_url( $custom ) : $permalink;
}
?>
