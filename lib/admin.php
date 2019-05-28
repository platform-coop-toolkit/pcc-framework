<?php

namespace PCCFramework\Admin;

function enqueue_assets()
{
    // TODO: Build to /build directory
    wp_enqueue_style('platformcoop-support', plugin_dir_url(dirname(__FILE__)) . '/src/admin.css', false, null);
}
