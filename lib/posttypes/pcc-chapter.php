<?php

/**
 * Registers the `pcc_chapter` post type.
 */
function pcc_chapter_init()
{
    register_post_type('pcc-chapter', array(
        'labels'                => array(
            'name'                  => __('Chapters', 'platformcoop-support'),
            'singular_name'         => __('Chapter', 'platformcoop-support'),
            'all_items'             => __('All Chapters', 'platformcoop-support'),
            'archives'              => __('Chapter Archives', 'platformcoop-support'),
            'attributes'            => __('Chapter Attributes', 'platformcoop-support'),
            'insert_into_item'      => __('Insert into Chapter', 'platformcoop-support'),
            'uploaded_to_this_item' => __('Uploaded to this Chapter', 'platformcoop-support'),
            'featured_image'        => _x('Featured Image', 'pcc-chapter', 'platformcoop-support'),
            'set_featured_image'    => _x('Set featured image', 'pcc-chapter', 'platformcoop-support'),
            'remove_featured_image' => _x('Remove featured image', 'pcc-chapter', 'platformcoop-support'),
            'use_featured_image'    => _x('Use as featured image', 'pcc-chapter', 'platformcoop-support'),
            'filter_items_list'     => __('Filter Chapters list', 'platformcoop-support'),
            'items_list_navigation' => __('Chapters list navigation', 'platformcoop-support'),
            'items_list'            => __('Chapters list', 'platformcoop-support'),
            'new_item'              => __('New Chapter', 'platformcoop-support'),
            'add_new'               => __('Add New', 'platformcoop-support'),
            'add_new_item'          => __('Add New Chapter', 'platformcoop-support'),
            'edit_item'             => __('Edit Chapter', 'platformcoop-support'),
            'view_item'             => __('View Chapter', 'platformcoop-support'),
            'view_items'            => __('View Chapters', 'platformcoop-support'),
            'search_items'          => __('Search Chapters', 'platformcoop-support'),
            'not_found'             => __('No Chapters found', 'platformcoop-support'),
            'not_found_in_trash'    => __('No Chapters found in trash', 'platformcoop-support'),
            'parent_item_colon'     => __('Parent Chapter:', 'platformcoop-support'),
            'menu_name'             => __('Chapters', 'platformcoop-support'),
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
        'rest_base'             => 'pcc-chapter',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));
}
add_action('init', 'pcc_chapter_init');

/**
 * Sets the post updated messages for the `pcc_chapter` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_chapter` post type.
 */
function pcc_chapter_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['pcc-chapter'] = array(
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Chapter updated. <a target="_blank" href="%s">View Chapter</a>', 'platformcoop-support'), esc_url($permalink)),
        2  => __('Custom field updated.', 'platformcoop-support'),
        3  => __('Custom field deleted.', 'platformcoop-support'),
        4  => __('Chapter updated.', 'platformcoop-support'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Chapter restored to revision from %s', 'platformcoop-support'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        /* translators: %s: post permalink */
        6  => sprintf(__('Chapter published. <a href="%s">View Chapter</a>', 'platformcoop-support'), esc_url($permalink)),
        7  => __('Chapter saved.', 'platformcoop-support'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Chapter submitted. <a target="_blank" href="%s">Preview Chapter</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(
            __('Chapter scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Chapter</a>', 'platformcoop-support'),
            date_i18n(__('M j, Y @ G:i', 'platformcoop-support'), strtotime($post->post_date)),
            esc_url($permalink)
        ),
        /* translators: %s: post permalink */
        10 => sprintf(__('Chapter draft updated. <a target="_blank" href="%s">Preview Chapter</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}
add_filter('post_updated_messages', 'pcc_chapter_updated_messages');
