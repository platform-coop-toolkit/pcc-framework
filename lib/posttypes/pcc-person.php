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
        'name' => __('Short Title', 'pcc-framework'),
        'id'   => $prefix . 'short_title',
        'type' => 'text',
        'description' => // @codingStandardsIgnoreStart
            __('A short title which describes this person&rsquo;s work and primary affiliation that will be used on their card. For example: <br />
            &ldquo;Founding Director, Institute for the Cooperative Digital Economy&rdquo;', 'pcc-framework'), // @codingStandardsIgnoreEnd
    ]);

    $cmb->add_field([
        'name' => __('Full Title', 'pcc-framework'),
        'id'   => $prefix . 'title',
        'type' => 'textarea',
        'description' => // @codingStandardsIgnoreStart
            __('A full title which describes this person&rsquo;s work and affiliations that will be used on their page. For example:<br />
            &ldquo;Founding Director of Institute for the Cooperative Digital Economy, Platform Cooperativism Consortium, The New School&rdquo;', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('City/Town', 'pcc-framework'),
        'id'   => $prefix . 'locality',
        'type' => 'text',
        'description' => __('The city or town where the person resides.', 'pcc-framework'),
    ]);

    $cmb->add_field([
        'name' => __('Country', 'pcc-framework'),
        'id'   => $prefix . 'country',
        'type' => 'text',
        'description' => __('The country where the person resides.', 'pcc-framework'),
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

    $cmb->add_field([
        'name' => __('Project or Organization (DEPRECATED)', 'pcc-framework'),
        'id'   => $prefix . 'organization',
        'type' => 'text',
        'description' =>
            __('The name of the organization with which this person is primarily affiliated.<br />
            <strong>THIS FIELD IS NO LONGER USED. INCLUDE THE PROJECT OR ORGANIZATION IN THE SHORT/FULL TITLE FIELDS ABOVE.</strong>', 'pcc-framework'),
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

    $cmb->add_field([
        'name'        => __('Show on People page', 'pcc-framework'),
        'id'          => $prefix . 'show_on_people',
        'type'        => 'checkbox',
        'description' =>
            __('Should this person be shown on the main People page?', 'pcc-framework'),
    ]);
}
