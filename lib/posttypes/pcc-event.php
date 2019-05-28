<?php

namespace PlatformCoop\PostTypes\Event;

use function PlatformCoop\PostTypes\Person\get_people;

/**
 * Registers the `pcc-event` post type.
 *
 * @return null
 */
function init()
{
    register_extended_post_type(
        'pcc-event',
        [
            'hierarchical' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'menu_position' => 24,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'page-attributes', 'custom-fields', 'thumbnail'],
        ],
        [
            'singular' => __('Event', 'platformcoop-support'),
            'plural' => __('Events', 'platformcoop-support'),
            'slug' => 'events'
        ]
    );
}

/**
 * Registers meta fields for the `pcc-event` post type.
 *
 * @return null
 */
function register_meta()
{
    register_post_meta('pcc-event', 'pcc_event_start', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
    ]);
    register_post_meta('pcc-event', 'pcc_event_end', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
    ]);
    register_post_meta('pcc-event', 'pcc_event_venue', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
    register_post_meta('pcc-event', 'pcc_event_venue_address', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
    register_post_meta('pcc-event', 'pcc_event_registration_url', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
    register_post_meta('pcc-event', 'pcc_event_type', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
}

/**
 * Registers the Event Data metabox and meta fields.
 *
 * @return null
 */
function data()
{
    $prefix = 'pcc_event_';

    $cmb = new_cmb2_box([
        'id'            => 'event_data',
        'title'         => __('Event Data', 'platformcoop-support'),
        'object_types'  => ['pcc-event'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb->add_field([
        'name' => __('Start', 'platformcoop-support'),
        'id' => $prefix . 'start',
        'type' => 'text_datetime_timestamp'
    ]);

    $cmb->add_field([
        'name' => __('End', 'platformcoop-support'),
        'id' => $prefix . 'end',
        'type' => 'text_datetime_timestamp'
    ]);

    $cmb->add_field([
        'name' => __('Venue', 'platformcoop-support'),
        'id'   => $prefix . 'venue',
        'type' => 'text',
    ]);

    $cmb->add_field([
        'name' => __('Venue Address', 'platformcoop-support'),
        'id'   => $prefix . 'venue_address',
        'type' => 'textarea_small',
    ]);

    $cmb->add_field([
        'name' => __('Registration Link', 'platformcoop-support'),
        'id'   => $prefix . 'registration_url',
        'type' => 'text_url',
        'protocols' => ['http', 'https'],
        'show_on_cb' => 'PlatformCoop\PostTypes\Event\is_parent_event'
    ]);

    $cmb->add_field([
        'name' => __('Event Type', 'platformcoop-support'),
        'id'   => $prefix . 'type',
        'type' => 'select',
        'show_option_none' => false,
        'default' => 'pcc',
        'options' => [
            'community' => __('Community Event', 'platformcoop-support'),
            'conference' => __('PCC Conference', 'platformcoop-support'),
            'pcc' => __('PCC Event', 'platformcoop-support'),
            'icde' => __('ICDE Event', 'platformcoop-support'),
        ],
        'show_on_cb' => 'PlatformCoop\PostTypes\Event\is_parent_event'
    ]);

    $cmb->add_field([
        'name' => __('Participants', 'platformcoop-support'),
        'id'   => $prefix . 'participants',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_people(),
        'repeatable' => true,
        'text' => [
            'add_row_text' => __('Add Participant', 'platformcoop-support'),
        ]
    ]);
}

/**
 * Registers the Event Sponsors metabox and meta fields.
 *
 * @return null
 */
function sponsors()
{
    $prefix = 'pcc_event_';

    $cmb = new_cmb2_box([
        'id'            => 'event_sponsors',
        'title'         => __('Event Sponsors', 'platformcoop-support'),
        'object_types'  => ['pcc-event'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on_cb'    => 'PlatformCoop\PostTypes\Event\is_parent_event'
    ]);

    $sponsor_id = $cmb->add_field([
        'id' => $prefix . 'sponsors',
        'type' => 'group',
        'options' => [
            'group_title' => __('Sponsor {#}', 'platformcoop-support'),
            'add_button' => __('Add Sponsor', 'platformcoop-support'),
            'remove_button' => __('Remove Sponsor', 'platformcoop-support'),
            'sortable' => true,
        ],
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Name', 'platformcoop-support'),
        'id'   => 'name',
        'type' => 'text',
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Link', 'platformcoop-support'),
        'id' => 'link',
        'type' => 'text_url',
        'protocols' => ['http', 'https'],
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Logo', 'platformcoop-support'),
        'id' => 'logo',
        'type'    => 'file',
        'options' => [
            'url' => false,
        ],
        'text' => [
            'add_upload_file_text' => __('Add/Upload Logo', 'platformcoop-support')
        ],
        'query_args' => [
            'type' => [
                'image/jpeg',
                'image/png',
            ]
        ],
        'preview_size' => 'medium',
    ]);
}

/**
 * Determine if event is a parent or a child (for CMB2's `show_on` callback).
 *
 * @param mixed $cmb The CMB2 meta box.
 *
 * @return bool
 */
function is_parent_event($cmb)
{
    return empty(get_post_ancestors($cmb->object_id));
}
