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
