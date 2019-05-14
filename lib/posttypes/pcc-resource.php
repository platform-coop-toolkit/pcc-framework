<?php

/**
 * Registers the `pcc_resource` post type.
 */
function pcc_resource_init()
{
    register_post_type('pcc-resource', array(
        'labels'                => array(
            'name'                  => __('Resources', 'platformcoop-support'),
            'singular_name'         => __('Resource', 'platformcoop-support'),
            'all_items'             => __('All Resources', 'platformcoop-support'),
            'archives'              => __('Resource Archives', 'platformcoop-support'),
            'attributes'            => __('Resource Attributes', 'platformcoop-support'),
            'insert_into_item'      => __('Insert into Resource', 'platformcoop-support'),
            'uploaded_to_this_item' => __('Uploaded to this Resource', 'platformcoop-support'),
            'featured_image'        => _x('Featured Image', 'pcc-resource', 'platformcoop-support'),
            'set_featured_image'    => _x('Set featured image', 'pcc-resource', 'platformcoop-support'),
            'remove_featured_image' => _x('Remove featured image', 'pcc-resource', 'platformcoop-support'),
            'use_featured_image'    => _x('Use as featured image', 'pcc-resource', 'platformcoop-support'),
            'filter_items_list'     => __('Filter Resources list', 'platformcoop-support'),
            'items_list_navigation' => __('Resources list navigation', 'platformcoop-support'),
            'items_list'            => __('Resources list', 'platformcoop-support'),
            'new_item'              => __('New Resource', 'platformcoop-support'),
            'add_new'               => __('Add New', 'platformcoop-support'),
            'add_new_item'          => __('Add New Resource', 'platformcoop-support'),
            'edit_item'             => __('Edit Resource', 'platformcoop-support'),
            'view_item'             => __('View Resource', 'platformcoop-support'),
            'view_items'            => __('View Resources', 'platformcoop-support'),
            'search_items'          => __('Search Resources', 'platformcoop-support'),
            'not_found'             => __('No Resources found', 'platformcoop-support'),
            'not_found_in_trash'    => __('No Resources found in trash', 'platformcoop-support'),
            'parent_item_colon'     => __('Parent Resource:', 'platformcoop-support'),
            'menu_name'             => __('Resources', 'platformcoop-support'),
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
        'rest_base'             => 'pcc-resource',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));
}
add_action('init', 'pcc_resource_init');

/**
 * Sets the post updated messages for the `pcc_resource` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_resource` post type.
 */
function pcc_resource_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['pcc-resource'] = array(
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Resource updated. <a target="_blank" href="%s">View Resource</a>', 'platformcoop-support'), esc_url($permalink)),
        2  => __('Custom field updated.', 'platformcoop-support'),
        3  => __('Custom field deleted.', 'platformcoop-support'),
        4  => __('Resource updated.', 'platformcoop-support'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Resource restored to revision from %s', 'platformcoop-support'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        /* translators: %s: post permalink */
        6  => sprintf(__('Resource published. <a href="%s">View Resource</a>', 'platformcoop-support'), esc_url($permalink)),
        7  => __('Resource saved.', 'platformcoop-support'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Resource submitted. <a target="_blank" href="%s">Preview Resource</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(
            __('Resource scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Resource</a>', 'platformcoop-support'),
            date_i18n(__('M j, Y @ G:i', 'platformcoop-support'), strtotime($post->post_date)),
            esc_url($permalink)
        ),
        /* translators: %s: post permalink */
        10 => sprintf(__('Resource draft updated. <a target="_blank" href="%s">Preview Resource</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}
add_filter('post_updated_messages', 'pcc_resource_updated_messages');
