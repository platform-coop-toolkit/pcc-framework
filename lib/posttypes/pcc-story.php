<?php

namespace PCCFramework\PostTypes\Story;
use function PCCFramework\PostTypes\Person\get_people;

/**
 * Registers the `pcc-story` post type.
 */
function init()
{
    register_extended_post_type(
        'pcc-story',
        [
            'has_archive' => false,
            'menu_icon' => 'dashicons-microphone',
            'menu_position' => 24,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'],
            'template' => [
                [
                    'core/quote'
                ],
            ],
            'template_lock' => 'all',
            'admin_cols' => [
                'title',
                'sector' => [
                    'sector' => __('Sector', 'pcc-framework'),
                    'taxonomy' => 'pcc-sector',
                ],
                'regions' => [
                    'title' => __('Regions', 'pcc-framework'),
                    'taxonomy' => 'pcc-region',
                ],
                'organization' => [
                    'title' => __('Organization', 'pcc-framework'),
                    'taxonomy' => 'pcc-organization',
                ],
                'tags' => [
                    'title' => __('Tags', 'pcc-framework'),
                    'taxonomy' => 'post_tag',
                ]
            ],
            'taxonomies' => ['post_tag', 'pcc-sector', 'pcc-region', 'pcc-organization'],
        ],
        [
            'singular' => __('Story', 'pcc-framework'),
            'plural' => __('Stories', 'pcc-framework'),
            'slug' => 'stories',
        ]
    );
}

/**
 * Registers meta fields for the `pcc-story` post type.
 *
 * @return null
 */
function register_meta()
{
    register_post_meta('pcc-story', 'pcc_story_video_link', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'wp_http_validate_url',
    ]);

    register_post_meta('pcc-story', 'pcc_story_organization', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);

    register_post_meta('pcc-story', 'pcc_story_storyteller', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);

    register_post_meta('pcc-story', 'pcc_story_region', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);

    register_post_meta('pcc-story', 'pcc_story_sector', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
}


/**
 * Registers the Story Data metabox and meta fields.
 *
 * @return null
 */
function data()
{
    $prefix = 'pcc_story_';

    $cmb = new_cmb2_box([
        'id'            => 'story_data',
        'title'         => __('Story Details', 'pcc-framework'),
        'object_types'  => ['pcc-story'],
        'context'       => 'side',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb->add_field([
        'name' => __('Story Video Link', 'pcc-framework'),
        'id'   => $prefix . 'video_link',
        'type' => 'text_url',
        'protocols' => [ 'http', 'https' ],
        'description' =>
            __('Link to the video (i.e. on Youtube).', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Storyteller', 'pcc-framework'),
        'desc' =>
            sprintf( __('Name of the person who is telling this story. <a href="%s">Add a new person</a> if they do not appear on the list.', 'pcc-framework'), admin_url('/post-new.php?post_type=pcc-person')),
        'id'   => $prefix . 'storyteller',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_people()
    ]);

    $cmb->add_field([
        'name' => __('Organization', 'pcc-framework'),
        'description' =>
            sprintf( __('Primary organization featured in this story. <a href="%s">Add a new organization</a> if it does not appear on the list.', 'pcc-framework'), admin_url('/edit-tags.php?taxonomy=pcc-organization&post_type=pcc-story')),
        'id'   => $prefix . 'organization',
        'taxonomy' => 'pcc-organization',
        'type' => 'taxonomy_select',
        'remove_default' => 'true',
    ]);

    $cmb->add_field([
        'name' => __('Regions', 'pcc-framework'),
        'description' =>
            sprintf( __('Relevant geographic region(s) associated with this story. <a href="%s">Add a new region</a> if it does not appear on the list.', 'pcc-framework'), admin_url('/edit-tags.php?taxonomy=pcc-region&post_type=pcc-story')),
        'id'   => $prefix . 'region',
        'taxonomy' => 'pcc-region',
        'type' => 'taxonomy_multicheck_hierarchical',
        'remove_default' => 'true',
    ]);

    $cmb->add_field([
        'name' => __('Sector', 'pcc-framework'),
        'description' =>
            sprintf( __('Industry or area of work / service. <a href="%s">Add a new sector</a> if it does not appear on the list.', 'pcc-framework'), admin_url('/edit-tags.php?taxonomy=pcc-sector&post_type=pcc-story')),
        'id'   => $prefix . 'sector',
        'taxonomy' => 'pcc-sector',
        'type' => 'taxonomy_multicheck_hierarchical',
        'remove_default' => 'true',
    ]);
}
