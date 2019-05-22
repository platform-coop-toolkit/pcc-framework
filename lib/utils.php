<?php

namespace PlatformCoop\Utils;

/**
 * Wrapper function around cmb2_get_option
 *
 * @since 0.1.0
 *
 * @param string $key Options array key
 * @param mixed $default Optional default value
 *
 * @return mixed Option value
 */
function get_config_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        return cmb2_get_option('platformcoop_configuration', $key, $default);
    }
    $opts = get_option('platformcoop_configuration', $default);
    $val = $default;
    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[ $key ]) {
        $val = $opts[ $key ];
    }
    return $val;
}

/**
 * Error handler.
 *
 * @since 0.4.0
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 *
 * @return null
 */
function error_handler($message, $subtitle = '', $title = '')
{
    $title = $title ?: __('Platform Co-op &rsaquo; Error', 'sage');
    $footer = '<a href="https://github.com/platform-coop-toolkit/platformcoop-support/wiki/">Documentation</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
}
