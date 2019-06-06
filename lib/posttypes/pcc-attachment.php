<?php

namespace PCCFramework\PostTypes\Attachment;

/**
 * Registers the Attachment Data meta fields.
 *
 * @return null
 */
function data($form_fields, $post)
{
    $prefix = 'pcc_attachment_';
    $creator_name = get_post_meta($post->ID, $prefix . 'creator_name', true);
    $creator_link = get_post_meta($post->ID, $prefix . 'creator_link', true);
    $organization_name = get_post_meta($post->ID, $prefix . 'organization_name', true);
    $organization_link = get_post_meta($post->ID, $prefix . 'organization_link', true);

    $form_fields[$prefix . 'creator_name'] = [
        'value' => $creator_name ?? '',
        'label' => __('Creator Name', 'pcc-framework'),
        'input' => 'text',
        'helps' => __('The name of the person who created this image or video.', 'pcc-framework'),
    ];
    $form_fields[$prefix . 'creator_link'] = [
        'value' => $creator_link ?? '',
        'label' => __('Creator Link', 'pcc-framework'),
        'input' => 'html',
        'helps' => __('A hyperlink to the website of the person who created this image or video.', 'pcc-framework'),
        'html' => sprintf(
            '<input type="url" id="%1$s" class="regular-text code" name="%2$s" value="%3$s" />',
            "attachments-$post->ID-{$prefix}creator_link",
            "attachments[$post->ID][{$prefix}creator_link]",
            esc_url($creator_link),
        ),
    ];
    $form_fields[$prefix . 'organization_name'] = [
        'value' => $organization_name ?? '',
        'label' => __('Organization Name', 'pcc-framework'),
        'input' => 'text',
        'helps' => __('The name of the organization who created this image or video.', 'pcc-framework'),
    ];
    $form_fields[$prefix . 'organization_link'] = [
        'value' => $organization_link ?? '',
        'label' => __('Organization Link', 'pcc-framework'),
        'input' => 'html',
        'helps' =>
            __('A hyperlink to the website of the organization who created this image or video.', 'pcc-framework'),
        'html' =>sprintf(
            '<input type="url" id="%1$s" class="regular-text code" name="%2$s" value="%3$s" />',
            "attachments-$post->ID-{$prefix}organization_link",
            "attachments[$post->ID][{$prefix}organization_link]",
            esc_url($organization_link),
        ),
    ];


    return $form_fields;
}

/**
 * Handle saving attachment data.
 *
 * @param int $post_id
 */
function save($post_id)
{
    $prefix = 'pcc_attachment_';
    $fields = [
        $prefix . 'creator_name' => 'sanitize_text_field',
        $prefix . 'creator_link' => 'esc_url',
        $prefix . 'organization_name' => 'sanitize_text_field',
        $prefix . 'organization_link' => 'esc_url',
    ];

    $data = [];

    foreach ($fields as $key => $cb) {
        if (isset($_REQUEST['attachments'][$post_id][$key])) {
            $data[ $key ] = $cb($_REQUEST['attachments'][$post_id][$key]);
            update_post_meta($post_id, $key, $data[ $key ]);
        }
    }
}
