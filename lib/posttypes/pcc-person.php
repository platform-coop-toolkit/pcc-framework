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
 * Registers meta fields for the `pcc-person` post type.
 *
 * @return null
 */
function register_meta()
{
    // TODO.
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
        'name' => __('Title or Occupation', 'pcc-framework'),
        'id'   => $prefix . 'title',
        'type' => 'text',
        'description' =>
            __('The job title or occupation of this person.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Project or Organization', 'pcc-framework'),
        'id'   => $prefix . 'organization',
        'type' => 'text',
        'description' =>
            __('The name of the organization with which this person is primarily affiliated.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Project or Organization Link (DEPRECATED)', 'pcc-framework'),
        'id'   => $prefix . 'organization_link',
        'type' => 'text_url',
        'description' =>
            __('A hyperlink to the project/organization with which this person is primarily affiliated.<br />
            <strong>THIS FIELD IS NO LONGER USED. ADD A LINK IN THE LINKS SECTION BELOW.</strong>', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name'        => __('Twitter Username (DEPRECATED)', 'pcc-framework'),
        'id'          => $prefix . 'twitter_username',
        'attributes'  => [ 'placeholder' => '@twitter' ],
        'type'        => 'text',
        'description' =>
            __('The person&rsquo;s Twitter username.<br />
            <strong>THIS FIELD IS NO LONGER USED. ADD A LINK IN THE LINKS SECTION BELOW.</strong>', 'pcc-framework'),
    ]);

    $group_field_id = $cmb->add_field([
        'id'          => $prefix . 'links',
        'type'        => 'group',
        'description' => __('Links which should be displayed on this person&rsquo;s profile.', 'pcc-framework'),
        'options'     => [
            'group_title'       => __('Link {#}', 'pcc-framework'),
            'add_button'        => __('Add Another Link', 'pcc-framework'),
            'remove_button'     => __('Remove Link', 'pcc-framework'),
            'sortable'          => true,
        ],
    ]);

    $cmb->add_group_field($group_field_id, [
        'name' => __('Link', 'pcc-framework'),
        'id'   => 'link',
        'type' => 'text_url',
    ]);

    $cmb->add_group_field($group_field_id, [
        'name' => __('Link Label (Optional)', 'pcc-framework'),
        'description' => __('The name of the linked website.', 'pcc-framework'),
        'id'   => 'label',
        'type' => 'text',
    ]);
}
