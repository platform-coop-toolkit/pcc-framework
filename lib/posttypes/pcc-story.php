<?php

namespace PCCFramework\PostTypes\Story;

// use function Altis\Workflow\PublicationChecklist\register_prepublish_check;
// use Altis\Workflow\PublicationChecklist\Status;

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
                'name' => [
                    'title' => __('Name', 'pcc-framework'),
                    'meta_key' => 'pcc_story_name',
                ],
                'sector' => [
                    'sector' => __('Sector', 'pcc-framework'),
                    'taxonomy' => 'pcc-sector',
                ],
                'regions' => [
                    'title' => __('Regions', 'pcc-framework'),
                    'taxonomy' => 'pcc-region',
                ],
                'tags' => [
                    'title' => __('Tags', 'pcc-framework'),
                    'taxonomy' => 'post_tag',
                ]
            ],
            'taxonomies' => ['post_tag', 'pcc-sector', 'pcc-region'],
        ],
        [
            'singular' => __('Story', 'pcc-framework'),
            'plural' => __('Stories', 'pcc-framework'),
            'slug' => 'stories',
        ]
    );
}

/**
 * Registers meta fields for the `pcc-voice` post type.
 *
 * @return null
 */
function register_meta()
{
    register_post_meta('pcc-story', 'pcc_story_organization', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function () {
            return current_user_can('edit_posts');
        }
    ]);

    register_post_meta('pcc-story', 'pcc_story_video_link', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'wp_http_validate_url',
        'auth_callback' => function () {
            return current_user_can('edit_posts');
        }
    ]);

    register_post_meta('pcc-story', 'pcc_story_name', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function () {
            return current_user_can('edit_posts');
        }
    ]);
}
//
// function prepublish_check ($key) {
//     if (function_exists('\Altis\Workflow\PublicationChecklist\register_prepublish_check')) {
//         register_prepublish_check( '', [
//             'run_check' => function ( array $post, array $meta ) : Status {
//                 if ( isset( $meta[$key] ) ) {
//                     return new Status( Status::COMPLETE, $key + ' completed' );
//                 }
//
//                 return new Status( Status::INCOMPLETE, $key + 'missing' );
//             },
//         ] );
//     }
// }
