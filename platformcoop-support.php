<?php
/**
 * Plugin Name:     Platform Coop Support
 * Plugin URI:      https://platform.coop
 * Description:     Utilities for the Platform Cooperativism Consortium's website.
 * Author:          Platform Cooperativism Consortium
 * Author URI:      https://platform.coop
 * Text Domain:     platformcoop-support
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         PlatformCoop
 */

/*
foreach( [
	'pcc-chapter',
	'pcc-event',
	'pcc-job',
	'pcc-news',
	'pcc-person',
	'pcc-project',
	'pcc-resource',
	'pcc-story'
] as $post_type ) {
	require_once( dirname( __FILE__ ) . "/post-types/$post_type.php" );
}
*/

function pcc_child_page_list_render_callback( $attributes, $content ) {
	$content = '';

	global $post;

	if ( !isset($attributes['parent'])) {
		$parent = $post->ID;
	} else {
		$parent = $attributes['parent'];
	}

    $children = new WP_Query( array(
		'post_type' => 'page',
		'post_parent' => $parent,
		'post__not_in' => 0,
		'orderby' => 'menu_order',
		'order' => 'asc',
	) );


    if ( $children->have_posts() ) {
		while( $children->have_posts() ) {
			$children->the_post();
			$content .= sprintf( '<p>%s</p>', get_the_title() );
		}
	}

	wp_reset_postdata();

	return $content;
}

function pcc_assets() {
    wp_register_script(
        'pcc-blocks',
        plugins_url( 'build/index.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-data', 'wp-components', 'wp-i18n' )
    );

    register_block_type( 'pcc/child-page-list', array(
        'editor_script' => 'pcc-blocks',
		'render_callback' => 'pcc_child_page_list_render_callback',
		'attributes' => array(
			'parent' => array(
				'type' => 'number',
				'default' => false,
			)
		)
    ) );

}
add_action( 'init', 'pcc_assets' );

require_once __DIR__ . '/lib/settings.php';
