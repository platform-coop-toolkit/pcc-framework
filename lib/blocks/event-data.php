<?php

namespace PlatformCoop\Blocks\EventData;

function register_block()
{
    register_block_type(
        'pcc/event-data',
        [
            'editor_script' => 'platform-coop-blocks-js'
        ]
    );
}
