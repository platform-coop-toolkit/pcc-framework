<?php

namespace PCCFramework\PostTypes\Event;

use CommerceGuys\Addressing\Country\CountryRepository;
use function PCCFramework\PostTypes\Person\get_people;

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
            'singular' => __('Event', 'pcc-framework'),
            'plural' => __('Events', 'pcc-framework'),
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
    $countryRepository = new CountryRepository();
    $countries = [];
    foreach ($countryRepository->getAll() as $country) {
        $countries[$country->getCountryCode()] = $country->getName();
    }

    $cmb = new_cmb2_box([
        'id'            => 'event_data',
        'title'         => __('Event Data', 'pcc-framework'),
        'object_types'  => ['pcc-event'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb->add_field([
        'name' => __('Start', 'pcc-framework'),
        'id' => $prefix . 'start',
        'type' => 'text_datetime_timestamp',
        'description' =>
            __('The date and time at which the event begins.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('End', 'pcc-framework'),
        'id' => $prefix . 'end',
        'type' => 'text_datetime_timestamp',
        'description' =>
            __('The date and time at which the event ends.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Name', 'pcc-framework'),
        'id'   => $prefix . 'venue',
        'type' => 'text',
        'description' =>
            __('The name of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Street Address', 'pcc-framework'),
        'id'   => $prefix . 'venue_street_address',
        'type' => 'text',
        'description' =>
            __('The street address of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Town/City', 'pcc-framework'),
        'id'   => $prefix . 'venue_locality',
        'type' => 'text',
        'description' =>
            __('The town or city of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Region', 'pcc-framework'),
        'id'   => $prefix . 'venue_region',
        'type' => 'text',
        'description' =>
            __('The province, state, or region of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Postal Code', 'pcc-framework'),
        'id'   => $prefix . 'venue_postal_code',
        'type' => 'text',
        'description' =>
            __('The postal code of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Venue Country', 'pcc-framework'),
        'id'   => $prefix . 'venue_country',
        'type' => 'select',
        'default' => 'US',
        'options' => $countries,
        'description' =>
            __('The country of the event&rsquo;s principal venue.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Registration Link', 'pcc-framework'),
        'id'   => $prefix . 'registration_url',
        'type' => 'text_url',
        'protocols' => ['http', 'https'],
        'show_on_cb' => 'PCCFramework\PostTypes\Event\is_parent_event',
        'description' =>
            __('A hyperlink to the event&rsquo;s external registration page.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Event Type', 'pcc-framework'),
        'id'   => $prefix . 'type',
        'type' => 'select',
        'show_option_none' => false,
        'default' => 'pcc',
        'options' => [
            'community' => __('Community Event', 'pcc-framework'),
            'conference' => __('PCC Conference', 'pcc-framework'),
            'pcc' => __('PCC Event', 'pcc-framework'),
            'icde' => __('ICDE Event', 'pcc-framework'),
        ],
        'show_on_cb' => 'PCCFramework\PostTypes\Event\is_parent_event',
        'description' =>
            __('The type of event.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Participants', 'pcc-framework'),
        'id'   => $prefix . 'participants',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_people(),
        'repeatable' => true,
        'text' => [
            'add_row_text' => __('Add Participant', 'pcc-framework'),
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
        'title'         => __('Event Sponsors', 'pcc-framework'),
        'object_types'  => ['pcc-event'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on_cb'    => 'PCCFramework\PostTypes\Event\is_parent_event'
    ]);

    $sponsor_id = $cmb->add_field([
        'id' => $prefix . 'sponsors',
        'type' => 'group',
        'options' => [
            'group_title' => __('Sponsor {#}', 'pcc-framework'),
            'add_button' => __('Add Sponsor', 'pcc-framework'),
            'remove_button' => __('Remove Sponsor', 'pcc-framework'),
            'sortable' => true,
        ],
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Name', 'pcc-framework'),
        'id'   => 'name',
        'type' => 'text',
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Link', 'pcc-framework'),
        'id' => 'link',
        'type' => 'text_url',
        'protocols' => ['http', 'https'],
    ]);

    $cmb->add_group_field($sponsor_id, [
        'name' => __('Sponsor Logo', 'pcc-framework'),
        'id' => 'logo',
        'type'    => 'file',
        'options' => [
            'url' => false,
        ],
        'text' => [
            'add_upload_file_text' => __('Add/Upload Logo', 'pcc-framework')
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
