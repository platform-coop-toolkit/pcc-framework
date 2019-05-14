<?php

/**
 * Registers the `pcc_job` post type.
 */
function pcc_job_init()
{
    register_post_type('pcc-job', array(
        'labels'                => array(
            'name'                  => __('Jobs', 'platformcoop-support'),
            'singular_name'         => __('Job', 'platformcoop-support'),
            'all_items'             => __('All Jobs', 'platformcoop-support'),
            'archives'              => __('Job Archives', 'platformcoop-support'),
            'attributes'            => __('Job Attributes', 'platformcoop-support'),
            'insert_into_item'      => __('Insert into Job', 'platformcoop-support'),
            'uploaded_to_this_item' => __('Uploaded to this Job', 'platformcoop-support'),
            'featured_image'        => _x('Featured Image', 'pcc-job', 'platformcoop-support'),
            'set_featured_image'    => _x('Set featured image', 'pcc-job', 'platformcoop-support'),
            'remove_featured_image' => _x('Remove featured image', 'pcc-job', 'platformcoop-support'),
            'use_featured_image'    => _x('Use as featured image', 'pcc-job', 'platformcoop-support'),
            'filter_items_list'     => __('Filter Jobs list', 'platformcoop-support'),
            'items_list_navigation' => __('Jobs list navigation', 'platformcoop-support'),
            'items_list'            => __('Jobs list', 'platformcoop-support'),
            'new_item'              => __('New Job', 'platformcoop-support'),
            'add_new'               => __('Add New', 'platformcoop-support'),
            'add_new_item'          => __('Add New Job', 'platformcoop-support'),
            'edit_item'             => __('Edit Job', 'platformcoop-support'),
            'view_item'             => __('View Job', 'platformcoop-support'),
            'view_items'            => __('View Jobs', 'platformcoop-support'),
            'search_items'          => __('Search Jobs', 'platformcoop-support'),
            'not_found'             => __('No Jobs found', 'platformcoop-support'),
            'not_found_in_trash'    => __('No Jobs found in trash', 'platformcoop-support'),
            'parent_item_colon'     => __('Parent Job:', 'platformcoop-support'),
            'menu_name'             => __('Jobs', 'platformcoop-support'),
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
        'rest_base'             => 'pcc-job',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));
}
add_action('init', 'pcc_job_init');

/**
 * Sets the post updated messages for the `pcc_job` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_job` post type.
 */
function pcc_job_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['pcc-job'] = array(
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Job updated. <a target="_blank" href="%s">View Job</a>', 'platformcoop-support'), esc_url($permalink)),
        2  => __('Custom field updated.', 'platformcoop-support'),
        3  => __('Custom field deleted.', 'platformcoop-support'),
        4  => __('Job updated.', 'platformcoop-support'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Job restored to revision from %s', 'platformcoop-support'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        /* translators: %s: post permalink */
        6  => sprintf(__('Job published. <a href="%s">View Job</a>', 'platformcoop-support'), esc_url($permalink)),
        7  => __('Job saved.', 'platformcoop-support'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Job submitted. <a target="_blank" href="%s">Preview Job</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(
            __('Job scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Job</a>', 'platformcoop-support'),
            date_i18n(__('M j, Y @ G:i', 'platformcoop-support'), strtotime($post->post_date)),
            esc_url($permalink)
        ),
        /* translators: %s: post permalink */
        10 => sprintf(__('Job draft updated. <a target="_blank" href="%s">Preview Job</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}
add_filter('post_updated_messages', 'pcc_job_updated_messages');
