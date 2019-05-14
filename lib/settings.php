<?php

namespace PlatformCoop\Settings;

/**
 * Register Configuration settings page and meta fields.
 */
function page()
{
    $cmb = new_cmb2_box([
        'id' => 'platformcoop_configuration',
        'title' => __('Site Configuration', 'platformcoop-support'),
        'menu_title' => __('Configuration', 'platformcoop-support'),
        'object_types' => ['options-page'],
        'option_key' => 'platformcoop_configuration',
        'capability' => 'manage_options',
    ]);
    $cmb->add_field([
        'name' => __('Donate Link', 'platformcoop-support'),
        'desc' => __('Link to external donation form (used in site footer and some page templates).', 'platformcoop-support'),
        'id' => 'donate_link',
        'type' => 'text_url',
        'default' =>
            'https://go.newschool.edu/s/1811/17/interior.aspx?sid=1811&gid=2&pgid=537&cid=1698&dids=34&bledit=1',
    ]);
    $cmb->add_field([
        'name' => __('Newsletter Signup Text', 'platformcoop-support'),
        'desc' => __('Prompt for newsletter signup call to action (use in site footer).', 'platformcoop-support'),
        'id' => 'signup_text',
        'type' => 'textarea_small',
        'default' => 'Once a month, we’ll email you with the latest news and activity in the community.',
    ]);
    $cmb->add_field([
        'name' => __('Newsletter Signup Link', 'platformcoop-support'),
        'desc' => __('Link to external newsletter signup form (used in site footer and some page templates).', 'platformcoop-support'),
        'id' => 'signup_link',
        'type' => 'text_url',
        'default' => 'https://lists.riseup.net/www/info/platformcoop-newsletter',
    ]);
};
