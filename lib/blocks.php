<?php

namespace PlatformCoop\Blocks;

function register_block_assets()
{
    wp_register_script(
        'platform-coop-blocks-js',
        plugin_dir_url(dirname(__FILE__)) . 'build/index.js',
        [
            'wp-element',
            'wp-i18n',
            'wp-blocks',
            'wp-components'
        ],
        false,
        true
    );
}
