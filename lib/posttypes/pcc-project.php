<?php

/**
 * Registers the `pcc_project` post type.
 */
function pcc_project_init()
{
    register_post_type('pcc-project', array(
        'labels'                => array(
            'name'                  => __('Projects', 'platformcoop-support'),
            'singular_name'         => __('Project', 'platformcoop-support'),
            'all_items'             => __('All Projects', 'platformcoop-support'),
            'archives'              => __('Project Archives', 'platformcoop-support'),
            'attributes'            => __('Project Attributes', 'platformcoop-support'),
            'insert_into_item'      => __('Insert into Project', 'platformcoop-support'),
            'uploaded_to_this_item' => __('Uploaded to this Project', 'platformcoop-support'),
            'featured_image'        => _x('Featured Image', 'pcc-project', 'platformcoop-support'),
            'set_featured_image'    => _x('Set featured image', 'pcc-project', 'platformcoop-support'),
            'remove_featured_image' => _x('Remove featured image', 'pcc-project', 'platformcoop-support'),
            'use_featured_image'    => _x('Use as featured image', 'pcc-project', 'platformcoop-support'),
            'filter_items_list'     => __('Filter Projects list', 'platformcoop-support'),
            'items_list_navigation' => __('Projects list navigation', 'platformcoop-support'),
            'items_list'            => __('Projects list', 'platformcoop-support'),
            'new_item'              => __('New Project', 'platformcoop-support'),
            'add_new'               => __('Add New', 'platformcoop-support'),
            'add_new_item'          => __('Add New Project', 'platformcoop-support'),
            'edit_item'             => __('Edit Project', 'platformcoop-support'),
            'view_item'             => __('View Project', 'platformcoop-support'),
            'view_items'            => __('View Projects', 'platformcoop-support'),
            'search_items'          => __('Search Projects', 'platformcoop-support'),
            'not_found'             => __('No Projects found', 'platformcoop-support'),
            'not_found_in_trash'    => __('No Projects found in trash', 'platformcoop-support'),
            'parent_item_colon'     => __('Parent Project:', 'platformcoop-support'),
            'menu_name'             => __('Projects', 'platformcoop-support'),
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
        'rest_base'             => 'pcc-project',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));
}
add_action('init', 'pcc_project_init');

/**
 * Sets the post updated messages for the `pcc_project` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_project` post type.
 */
function pcc_project_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['pcc-project'] = array(
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Project updated. <a target="_blank" href="%s">View Project</a>', 'platformcoop-support'), esc_url($permalink)),
        2  => __('Custom field updated.', 'platformcoop-support'),
        3  => __('Custom field deleted.', 'platformcoop-support'),
        4  => __('Project updated.', 'platformcoop-support'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Project restored to revision from %s', 'platformcoop-support'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        /* translators: %s: post permalink */
        6  => sprintf(__('Project published. <a href="%s">View Project</a>', 'platformcoop-support'), esc_url($permalink)),
        7  => __('Project saved.', 'platformcoop-support'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Project submitted. <a target="_blank" href="%s">Preview Project</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(
            __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'platformcoop-support'),
            date_i18n(__('M j, Y @ G:i', 'platformcoop-support'), strtotime($post->post_date)),
            esc_url($permalink)
        ),
        /* translators: %s: post permalink */
        10 => sprintf(__('Project draft updated. <a target="_blank" href="%s">Preview Project</a>', 'platformcoop-support'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}
add_filter('post_updated_messages', 'pcc_project_updated_messages');
