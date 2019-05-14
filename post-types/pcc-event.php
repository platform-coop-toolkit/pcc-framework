<?php

/**
 * Registers the `pcc_event` post type.
 */
function pcc_event_init() {
	register_post_type( 'pcc-event', array(
		'labels'                => array(
			'name'                  => __( 'Events', 'platformcoop-support' ),
			'singular_name'         => __( 'Event', 'platformcoop-support' ),
			'all_items'             => __( 'All Events', 'platformcoop-support' ),
			'archives'              => __( 'Event Archives', 'platformcoop-support' ),
			'attributes'            => __( 'Event Attributes', 'platformcoop-support' ),
			'insert_into_item'      => __( 'Insert into Event', 'platformcoop-support' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Event', 'platformcoop-support' ),
			'featured_image'        => _x( 'Featured Image', 'pcc-event', 'platformcoop-support' ),
			'set_featured_image'    => _x( 'Set featured image', 'pcc-event', 'platformcoop-support' ),
			'remove_featured_image' => _x( 'Remove featured image', 'pcc-event', 'platformcoop-support' ),
			'use_featured_image'    => _x( 'Use as featured image', 'pcc-event', 'platformcoop-support' ),
			'filter_items_list'     => __( 'Filter Events list', 'platformcoop-support' ),
			'items_list_navigation' => __( 'Events list navigation', 'platformcoop-support' ),
			'items_list'            => __( 'Events list', 'platformcoop-support' ),
			'new_item'              => __( 'New Event', 'platformcoop-support' ),
			'add_new'               => __( 'Add New', 'platformcoop-support' ),
			'add_new_item'          => __( 'Add New Event', 'platformcoop-support' ),
			'edit_item'             => __( 'Edit Event', 'platformcoop-support' ),
			'view_item'             => __( 'View Event', 'platformcoop-support' ),
			'view_items'            => __( 'View Events', 'platformcoop-support' ),
			'search_items'          => __( 'Search Events', 'platformcoop-support' ),
			'not_found'             => __( 'No Events found', 'platformcoop-support' ),
			'not_found_in_trash'    => __( 'No Events found in trash', 'platformcoop-support' ),
			'parent_item_colon'     => __( 'Parent Event:', 'platformcoop-support' ),
			'menu_name'             => __( 'Events', 'platformcoop-support' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'editor', 'title' ),
		'has_archive'           => false,
		'rewrite'               => ['slug' => 'event'],
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_rest'          => true,
		'rest_base'             => 'pcc-event',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'pcc_event_init' );

/**
 * Sets the post updated messages for the `pcc_event` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_event` post type.
 */
function pcc_event_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['pcc-event'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Event updated. <a target="_blank" href="%s">View Event</a>', 'platformcoop-support' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'platformcoop-support' ),
		3  => __( 'Custom field deleted.', 'platformcoop-support' ),
		4  => __( 'Event updated.', 'platformcoop-support' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'platformcoop-support' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Event published. <a href="%s">View Event</a>', 'platformcoop-support' ), esc_url( $permalink ) ),
		7  => __( 'Event saved.', 'platformcoop-support' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'platformcoop-support' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'platformcoop-support' ),
		date_i18n( __( 'M j, Y @ G:i', 'platformcoop-support' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'platformcoop-support' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'pcc_event_updated_messages' );
