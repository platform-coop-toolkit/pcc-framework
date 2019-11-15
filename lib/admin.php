<?php

namespace PCCFramework\Admin;

function enqueue_assets()
{
    wp_enqueue_style(
        'pcc-framework',
        plugin_dir_url(dirname(__FILE__)) . '/build/admin.css',
        false,
        PCC_FRAMEWORK_VERSION
    );
}
