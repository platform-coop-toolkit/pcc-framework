<?php

namespace PCCFramework\Taxonomies\Organization;

/**
 * Registers the `pcc-organization` taxonomy,
 * for use with 'pcc-story'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-organization',
        'pcc-story',
        [
            'show_in_rest' => false,
            'required' => true,
        ],
        [
            'singular' => __('Organization', 'pcc-framework'),
            'plural'   => __('Organizations', 'pcc-framework'),
            'slug'     => __('organization', 'pcc-framework'),
        ]
    );
}

/**
 * Sets the post updated messages for the `pcc-organization` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc-organization` taxonomy.
 */
function updated_messages($messages)
{

    $messages['pcc-organization'] = [
        0 => '', // Unused. Messages start at index 1.
        1 => __('Organization added.', 'pcc-framework'),
        2 => __('Organization deleted.', 'pcc-framework'),
        3 => __('Organization updated.', 'pcc-framework'),
        4 => __('Organization not added.', 'pcc-framework'),
        5 => __('Organization not updated.', 'pcc-framework'),
        6 => __('Organizations deleted.', 'pcc-framework'),
    ];

    return $messages;
}
