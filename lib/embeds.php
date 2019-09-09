<?php

namespace PCCFramework\Embeds;

/**
 * Add OEmbed provider for livestream.com.
 *
 * @return null
 */
function init_livestream()
{
    wp_oembed_add_provider('https://livestream.com/accounts/*/events/*', 'https://livestream.com/oembed');
    wp_oembed_add_provider('https://livestream.com/accounts/*/events/*/videos/*', 'https://livestream.com/oembed');
    wp_oembed_add_provider('https://livestream.com/*/events/*', 'https://livestream.com/oembed');
    wp_oembed_add_provider('https://livestream.com/*/events/*/videos/*', 'https://livestream.com/oembed');
    wp_oembed_add_provider('https://livestream.com/*/*', 'https://livestream.com/oembed');
    wp_oembed_add_provider('https://livestream.com/*/*/videos/*', 'https://livestream.com/oembed');
}
