<?php

namespace PCCFramework\Admin;

function enqueue_assets()
{
    wp_enqueue_style(
        'pcc-framework',
        plugin_dir_url(dirname(__FILE__)) . '/build/admin.css',
        false,
        PCC_FRAMEWORK_VERSION
    );
}

function relabel_tags()
{
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = __('Topics', 'pcc-framework');
    $labels->menu_name = $labels->name;
    $labels->singular_name = __('Topics', 'pcc-framework');
    $labels->search_items = __('Search Topics', 'pcc-framework');
    $labels->all_items = __('Topics', 'pcc-framework');
    $labels->separate_items_with_commas = __('Separate Topics with commas', 'pcc-framework');
    $labels->choose_from_most_used = __('Choose from the most used Topics', 'pcc-framework');
    $labels->popular_items = __('Popular Topics', 'pcc-framework');
    $labels->edit_item = __('Edit Topic', 'pcc-framework');
    $labels->view_item = __('View Topic', 'pcc-framework');
    $labels->update_item = __('Update Topic', 'pcc-framework');
    $labels->add_new_item = __('Add New Topic', 'pcc-framework');
    $labels->new_item_name = __('Your New Topics Name', 'pcc-framework');
}
