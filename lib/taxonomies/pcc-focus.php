<?php

namespace PCCFramework\Taxonomies\Focus;

/**
 * Registers the `pcc_focs` taxonomy,
 * for use with 'pcc-person', 'pcc-resource', and 'post'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-focus',
        [
            'pcc-person',
            'post'
        ],
        [
            'hierarchical' => false,
            'show_in_rest' => true,
        ],
        [
            'singular' => __('Focus Area', 'pcc-framework'),
            'plural'   => __('Focus Areas', 'pcc-framework'),
            'slug'     => __('focus', 'pcc-framework'),
        ]
    );
}
