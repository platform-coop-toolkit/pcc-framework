<?php

namespace PCCFramework\Taxonomies\Region;

/**
 * Registers the `pcc-region` taxonomy,
 * for use with 'pcc-story'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-region',
        'pcc-story',
        [
            'show_in_rest' => false,
            'required' => true,
        ],
        [
            'singular' => __('Region', 'pcc-framework'),
            'plural'   => __('Regions', 'pcc-framework'),
            'slug'     => __('Region', 'pcc-framework'),
        ]
    );
}

/**
 * Sets the post updated messages for the `pcc-region` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_region` taxonomy.
 */
function updated_messages($messages)
{

    $messages['pcc-region'] = [
        0 => '', // Unused. Messages start at index 1.
        1 => __('Region added.', 'pcc-framework'),
        2 => __('Region deleted.', 'pcc-framework'),
        3 => __('Region updated.', 'pcc-framework'),
        4 => __('Region not added.', 'pcc-framework'),
        5 => __('Region not updated.', 'pcc-framework'),
        6 => __('Regions deleted.', 'pcc-framework'),
    ];

    return $messages;
}
