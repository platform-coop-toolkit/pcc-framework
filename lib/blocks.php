<?php

namespace PCCFramework\Blocks;

/**
 * Register assets for custom blocks.
 *
 * @return null
 */
function register_block_assets()
{
    $asset = require(dirname(dirname(__FILE__)) . '/build/index.asset.php');

    wp_register_script(
        'platform-coop-blocks-js',
        plugin_dir_url(dirname(__FILE__)) . '/build/index.js',
        $asset['dependencies'],
        $asset['version'],
        true
    );
}
