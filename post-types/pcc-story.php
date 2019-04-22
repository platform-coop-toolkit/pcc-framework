<?php

/**
 * Registers the `pcc_story` post type.
 */
function pcc_story_init() {
	register_post_type( 'pcc-story', array(
		'labels'                => array(
			'name'                  => __( 'Stories', 'platformcoop-support' ),
			'singular_name'         => __( 'Story', 'platformcoop-support' ),
			'all_items'             => __( 'All Stories', 'platformcoop-support' ),
			'archives'              => __( 'Story Archives', 'platformcoop-support' ),
			'attributes'            => __( 'Story Attributes', 'platformcoop-support' ),
			'insert_into_item'      => __( 'Insert into Story', 'platformcoop-support' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Story', 'platformcoop-support' ),
			'featured_image'        => _x( 'Featured Image', 'pcc-story', 'platformcoop-support' ),
			'set_featured_image'    => _x( 'Set featured image', 'pcc-story', 'platformcoop-support' ),
			'remove_featured_image' => _x( 'Remove featured image', 'pcc-story', 'platformcoop-support' ),
			'use_featured_image'    => _x( 'Use as featured image', 'pcc-story', 'platformcoop-support' ),
			'filter_items_list'     => __( 'Filter Stories list', 'platformcoop-support' ),
			'items_list_navigation' => __( 'Stories list navigation', 'platformcoop-support' ),
			'items_list'            => __( 'Stories list', 'platformcoop-support' ),
			'new_item'              => __( 'New Story', 'platformcoop-support' ),
			'add_new'               => __( 'Add New', 'platformcoop-support' ),
			'add_new_item'          => __( 'Add New Story', 'platformcoop-support' ),
			'edit_item'             => __( 'Edit Story', 'platformcoop-support' ),
			'view_item'             => __( 'View Story', 'platformcoop-support' ),
			'view_items'            => __( 'View Stories', 'platformcoop-support' ),
			'search_items'          => __( 'Search Stories', 'platformcoop-support' ),
			'not_found'             => __( 'No Stories found', 'platformcoop-support' ),
			'not_found_in_trash'    => __( 'No Stories found in trash', 'platformcoop-support' ),
			'parent_item_colon'     => __( 'Parent Story:', 'platformcoop-support' ),
			'menu_name'             => __( 'Stories', 'platformcoop-support' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'pcc-story',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'pcc_story_init' );

/**
 * Sets the post updated messages for the `pcc_story` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_story` post type.
 */
function pcc_story_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['pcc-story'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Story updated. <a target="_blank" href="%s">View Story</a>', 'platformcoop-support' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'platformcoop-support' ),
		3  => __( 'Custom field deleted.', 'platformcoop-support' ),
		4  => __( 'Story updated.', 'platformcoop-support' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Story restored to revision from %s', 'platformcoop-support' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Story published. <a href="%s">View Story</a>', 'platformcoop-support' ), esc_url( $permalink ) ),
		7  => __( 'Story saved.', 'platformcoop-support' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Story submitted. <a target="_blank" href="%s">Preview Story</a>', 'platformcoop-support' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Story scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Story</a>', 'platformcoop-support' ),
		date_i18n( __( 'M j, Y @ G:i', 'platformcoop-support' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Story draft updated. <a target="_blank" href="%s">Preview Story</a>', 'platformcoop-support' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'pcc_story_updated_messages' );
