<?php
/**
 * Plugin Name:     Platform Coop Support
 * Plugin URI:      https://platform.coop
 * Description:     Utilities for the Platform Cooperativism Consortium's website.
 * Author:          Platform Cooperativism Consortium
 * Author URI:      https://platform.coop
 * Text Domain:     platformcoop-support
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         PlatformCoop
 */

foreach ([
    // 'pcc-chapter',
    'pcc-event',
    // 'pcc-job',
    // 'pcc-news',
    // 'pcc-person',
    // 'pcc-project',
    // 'pcc-resource',
    // 'pcc-story'
] as $post_type) {
    require_once(dirname(__FILE__) . "/post-types/$post_type.php");
}

add_action('acf/init', function () {
    require __DIR__ . '/blocks/child-pages.php';
    require __DIR__ . '/blocks/social-links.php';
});

acf_add_options_page([ 'page_title' => __('Configuration', 'platformcoop-support') ]);
