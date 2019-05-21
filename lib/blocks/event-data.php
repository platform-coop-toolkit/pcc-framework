<?php

namespace PlatformCoop\Blocks\EventData;

/**
 * Register the Event Data block.
 *
 * @return null
 */
function register_block()
{
    register_block_type(
        'pcc/event-data',
        [
            'editor_script' => 'platform-coop-blocks-js'
        ]
    );
}
