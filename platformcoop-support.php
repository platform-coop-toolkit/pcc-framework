<?php
/**
 * Plugin Name:     Platform Coop Support
 * Plugin URI:      https://platform.coop
 * Description:     Utilities for the Platform Cooperativism Consortium's website.
 * Author:          Platform Cooperativism Consortium
 * Author URI:      https://platform.coop
 * Text Domain:     platformcoop-support
 * Domain Path:     /languages
 * Version:         0.3.0
 *
 * @package         PlatformCoop
 */

require_once dirname(__FILE__) . '/lib/utils.php';

foreach ([
    'event',
    'person',
] as $posttype) {
    require_once dirname(__FILE__) . "/lib/posttypes/pcc-$posttype.php";
    add_action('init', '\\PlatformCoop\\PostTypes\\' . ucfirst($posttype) . '\\init');
}

require_once dirname(__FILE__) . '/lib/blocks.php';

add_action('init', '\\PlatformCoop\\PostTypes\\Event\\register_meta');
add_action('init', '\\PlatformCoop\\Blocks\\register_block_assets');

foreach ([
    'child-pages',
    'social-links',
] as $block) {
    require_once dirname(__FILE__) . "/lib/blocks/$block.php";
    $pieces = explode('-', $block);
    $pieces = array_map('ucfirst', $pieces);
    $block = implode('', $pieces);
    add_action('init', "\\PlatformCoop\\Blocks\\$block\\register_block");
}

if (is_admin()) {
    require_once dirname(__FILE__) . '/lib/admin.php';
    require_once dirname(__FILE__) . '/lib/settings.php';

    add_action('admin_enqueue_scripts', '\\PlatformCoop\\Admin\\enqueue_assets');
    add_action('cmb2_admin_init', '\\PlatformCoop\\PostTypes\\Event\\data');
    add_action('cmb2_admin_init', '\\PlatformCoop\\PostTypes\\Event\\sponsors');
    add_action('cmb2_admin_init', '\\PlatformCoop\\Settings\\page');
}
