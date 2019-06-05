<?php

namespace PCCFramework\Taxonomies\Role;

/**
 * Registers the `pcc_role` taxonomy,
 * for use with 'pcc-person'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-role',
        'pcc-person',
        [
            'show_in_rest' => true,
        ],
        [
            'singular' => __('Role', 'pcc-framework'),
            'plural'   => __('Roles', 'pcc-framework'),
            'slug'     => __('role', 'pcc-framework'),
        ]
    );
}

/**
 * Sets the post updated messages for the `pcc_role` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `pcc_role` taxonomy.
 */
function updated_messages($messages)
{

    $messages['pcc-role'] = [
        0 => '', // Unused. Messages start at index 1.
        1 => __('Role added.', 'pcc-framework'),
        2 => __('Role deleted.', 'pcc-framework'),
        3 => __('Role updated.', 'pcc-framework'),
        4 => __('Role not added.', 'pcc-framework'),
        5 => __('Role not updated.', 'pcc-framework'),
        6 => __('Roles deleted.', 'pcc-framework'),
    ];

    return $messages;
}
// add_filter( 'term_updated_messages', 'pcc_role_updated_messages' );
