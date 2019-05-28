<?php
/**
 * Plugin Name:     Platform Cooperativism Consortium Framework
 * Plugin URI:      https://platform.coop
 * Description:     Utilities, custom post types and blocks for the Platform Cooperativism Consortium website.
 * Author:          Platform Cooperativism Consortium
 * Author URI:      https://platform.coop
 * Text Domain:     pcc-framework
 * Domain Path:     /languages
 * License:         BSD 3-Clause "New" License
 * License URI:     https://opensource.org/licenses/BSD-3-Clause
 * Version:         0.5.0
 *
 * @package         PCCFramework
 */

require_once dirname(__FILE__) . '/lib/utils.php';

/**
 * Ensure dependencies are loaded
 */
if (!function_exists('register_extended_post_type')) {
    if (!file_exists($composer = __DIR__.'/vendor/autoload.php')) {
        \PCCFramework\Utils\error_handler(
            __(
                'You must run <code>composer install</code> from the Platform Co-op Support directory.',
                'platformcoop-support'
            ),
            __('Autoloader not found.', 'pcc-framework')
        );
    }
    require_once $composer;
}

foreach ([
    'event',
    'person',
] as $posttype) {
    require_once dirname(__FILE__) . "/lib/posttypes/pcc-$posttype.php";
    add_action('init', '\\PCCFramework\\PostTypes\\' . ucfirst($posttype) . '\\init');
}

require_once dirname(__FILE__) . '/lib/blocks.php';

add_action('init', '\\PCCFramework\\PostTypes\\Event\\register_meta');
add_action('init', '\\PCCFramework\\Blocks\\register_block_assets');

foreach ([
    'child-pages',
    'social-links',
] as $block) {
    require_once dirname(__FILE__) . "/lib/blocks/$block.php";
    $pieces = explode('-', $block);
    $pieces = array_map('ucfirst', $pieces);
    $block = implode('', $pieces);
    add_action('init', "\\PCCFramework\\Blocks\\$block\\register_block");
}

if (is_admin()) {
    require_once dirname(__FILE__) . '/lib/admin.php';
    require_once dirname(__FILE__) . '/lib/settings.php';

    add_action('admin_enqueue_scripts', '\\PCCFramework\\Admin\\enqueue_assets');
    add_action('cmb2_admin_init', '\\PCCFramework\\PostTypes\\Event\\data');
    add_action('cmb2_admin_init', '\\PCCFramework\\PostTypes\\Event\\sponsors');
    add_action('cmb2_admin_init', '\\PCCFramework\\Settings\\page');
}
