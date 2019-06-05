<?php

namespace PCCFramework\PostTypes\Person;

/**
 * Registers the `pcc-person` post type.
 */
function init()
{
    register_extended_post_type(
        'pcc-person',
        [
            'menu_icon' => 'dashicons-businessperson',
            'menu_position' => 25,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'],
        ],
        [
            'singular' => __('Person', 'pcc-framework'),
            'plural' => __('People', 'pcc-framework'),
            'slug' => 'people',
        ]
    );
}

/**
 * Retrieves an array of people, sorted by name.
 *
 * @return array
 */
function get_people()
{
    $people = get_posts([
        'post_type' => 'pcc-person',
        'orderby' => 'post_title',
        'order' => 'asc',
        'posts_per_page' => -1,
    ]);

    $options = [];

    foreach ($people as $person) {
        $options[ $person->ID ] = $person->post_title;
    }

    return $options;
}

/**
 * Registers the Person Data metabox and meta fields.
 *
 * @return null
 */
function data()
{
    $prefix = 'pcc_person_';

    $cmb = new_cmb2_box([
        'id'            => 'person_data',
        'title'         => __('Person Data', 'pcc-framework'),
        'object_types'  => ['pcc-person'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb->add_field([
        'name' => __('Title', 'pcc-framework'),
        'id'   => $prefix . 'title',
        'type' => 'text',
        'description' =>
            __('The job title of this person.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Organization', 'pcc-framework'),
        'id'   => $prefix . 'organization',
        'type' => 'text',
        'description' =>
            __('The name of the organization with which this person is primarily affiliated.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Organization Link', 'pcc-framework'),
        'id'   => $prefix . 'organization_link',
        'type' => 'text_url',
        'description' =>
            __('A hyperlink organization with which this person is primarily affiliated.', 'pcc-framework'),
    ]);
}
