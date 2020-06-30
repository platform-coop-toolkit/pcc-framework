<?php

namespace PCCFramework\Taxonomies\Sector;

/**
 * Registers the `pcc-sector` taxonomy,
 * for use with 'pcc-story'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-sector',
        'pcc-story',
        [
            'show_in_rest' => false,
            'required' => true,
        ],
        [
            'singular' => __('Sector', 'pcc-framework'),
            'plural'   => __('Sectors', 'pcc-framework'),
            'slug'     => __('sector', 'pcc-framework'),
        ]
    );
}

/**
 * Sets the post updated messages for the `pcc-sector` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc-sector` taxonomy.
 */
function updated_messages($messages)
{

    $messages['pcc-sector'] = [
        0 => '', // Unused. Messages start at index 1.
        1 => __('Sector added.', 'pcc-framework'),
        2 => __('Sector deleted.', 'pcc-framework'),
        3 => __('Sector updated.', 'pcc-framework'),
        4 => __('Sector not added.', 'pcc-framework'),
        5 => __('Sector not updated.', 'pcc-framework'),
        6 => __('Sectors deleted.', 'pcc-framework'),
    ];

    return $messages;
}
